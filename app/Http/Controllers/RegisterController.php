<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        User::create($validatedData);

        return redirect('/login')->with('success', 'User Berhasil Ditambahkan, Silahkan Login');
    }
}
