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
            $request->session()->regenerate();

            $user = Auth::user();

            if($user->role === 'admin'){
                return redirect()->intended('/admin');
            }
            if ($user->role === 'shelter_owner') {
                return redirect()->intended('/shelter');
            }
            return redirect()->intended('/home');
        }
        else {
            return back()->withErrors([
                'email'=>'Login Failed',
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
