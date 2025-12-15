<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdoptionRequestToOwner;
use App\Mail\AdoptionRequestToUser;

class UserController extends Controller
{
    public function submitAdoptForm(Request $request){
        $doge = Doge::find($request->id);

        if($doge->adoption_status === 'available'){
            $user = User::find(Auth::id());
            $user->no_telp = $request->no_telp; 
            $user->save();
            $doge->user_id = $user->id;
            $doge->adoption_status = 'pending';
            $doge->pesan_adopsi = $request->pesan;
            $doge->save();

            // Notify shelter owner and user
            $shelter = $doge->shelter;
            if ($shelter && $shelter->user_id) {
                try { Mail::to($shelter->user->email)->send(new AdoptionRequestToOwner($doge)); } catch (\Exception $e) {}
            }
            try { Mail::to($user->email)->send(new AdoptionRequestToUser($doge)); } catch (\Exception $e) {}
    
            return redirect()->route("home")->with("success", "Form submitted successfully, admin will verify your request. Please wait, Admin will contact you later through your contacts.");
        } else if ($doge->adoption_status === 'pending'){
            return redirect()->route("home")->with("error", "This dog is already in pending adoption.");
        } else {
            return redirect()->route("home")->with("error", "This dog is not available for adoption.");
        }
    }

    public function fetchAdopt($id){
        $doge = Doge::findOrFail($id);

        return view('user.adoptForm', compact('doge'));
    }
}

