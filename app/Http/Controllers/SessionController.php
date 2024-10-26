<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index(){
        return view('session.login');
    }

    public function login(Request $request){
        $data=$request->validate([
            'email'=>'required|email:dns',
            'password'=>'required',
        ]);

        if(Auth::attempt($data)){
            return redirect()->route('home');

            if (Auth::User()->role === 'admin') {
                return redirect()->route('home');
            } elseif (Auth::User()->role === 'user') {
                return redirect()->route('home');
            }

        }
        else {
            return back()->withErrors([
                'email'=>'Email or password is incorrect',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
