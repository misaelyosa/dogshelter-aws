<?php

namespace App\Http\Controllers;

use App\Models\Doge;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNewShelterRequest;
use App\Models\User;

class ShelterController extends Controller
{
    public function index()
    {
        $doges = Doge::with('shelter')->get();
        $shelters = Shelter::all();

        return view('home', compact('doges', 'shelters'));
    }

    public function showVerifyForm()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'shelter_owner') {
            return redirect()->route('home')->withErrors('Unauthorized');
        }

        // If shelter already exists for this user, load it
        $shelter = Shelter::where('user_id', $user->id)->first();

        return view('shelter.verify', compact('shelter'));
    }

    public function submitVerify(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'shelter_owner') {
            return redirect()->route('home')->withErrors('Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|required_with:longitude',
            'longitude' => 'nullable|numeric|required_with:latitude',
            'capacity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'email' => 'nullable|email',
            'image' => 'nullable|image|max:2048',
        ]);

        $shelter = Shelter::updateOrCreate(
            ['user_id' => $user->id],
            array_merge($validated, ['user_id' => $user->id, 'is_verified' => false])
        );

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'shelter_' . $user->id . '_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            // store under 'sheltersVerif/' prefix on the s3 disk
            $path = $file->storeAs('sheltersVerif', $filename, 's3');
            // save DB path as sheltersVerif/filename
            $shelter->image = 'sheltersVerif/' . $filename;
            $shelter->save();
        }

        // Redirect back to the verification page with a submitted notice
        // Notify admins about new shelter request
        $adminEmails = User::where('role', 'admin')->pluck('email')->filter()->toArray();
        foreach ($adminEmails as $email) {
            try { Mail::to($email)->send(new AdminNewShelterRequest($shelter)); } catch (\Exception $e) { /* ignore mail errors for now */ }
        }

        return redirect()->route('shelter.verify.form')->with(['submitted' => true, 'success' => 'Shelter details submitted. Please wait for admin approval and check your email.']);
    }
}
