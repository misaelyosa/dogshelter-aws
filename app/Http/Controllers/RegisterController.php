<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:user,shelter_owner',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        // Ensure role fallback
        if (empty($validatedData['role'])) {
            $validatedData['role'] = 'user';
        }

        $user = User::create($validatedData);

        // Log in the user so shelter owners can submit verification details immediately
        Auth::login($user);

        if ($user->role === 'shelter_owner') {
            return redirect()->route('shelter.verify.form')->with('success', 'Please complete your shelter details to finish registration.');
        }

        Auth::logout();
        return redirect('/login')->with('success', 'User Berhasil Ditambahkan, Silahkan Login');
    }
}
