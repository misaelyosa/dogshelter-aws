<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function submitAdoptForm(Request $request){
        $doge = Doge::find($request->id);

        if($doge->adoption_status === 'available'){
            $user = Auth::user();
            $user->name = $request->name;
            $user->no_telp = $request->no_telp; 
            $doge->user_id = $user->id;
            $doge->adoption_status = 'pending';
            $doge->save();
    
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

