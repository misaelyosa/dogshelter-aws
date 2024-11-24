<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;

class DogeController extends Controller
{
    public function fetch(){
        $doges = Doge::all();

        return view('home', ['doges' => $doges]);
    }

    public function fetchDogeAdmin(){
        $doges = Doge::all();

        return view('admin/tableDoge', ['doges' => $doges]);
    }

    public function fetchAdoptionRequest(){
        $doges = Doge::whereNotNull('user_id')->get();

        $userIds = $doges->pluck('user_id');
        $adopters = User::whereIn('id', $userIds)->get();
        // dd($doges, $adopters);

        return view('admin.reviewAdoptionRequest', compact('adopters', 'doges'));
    }

    public function acceptAdopt(Request $request){
        $doge = Doge::find($request->id); 

        if ($doge && $doge->adoption_status === 'pending') {
            $doge->adoption_status = 'not available';
            dd($doge);
            $doge->save(); 
    
            return redirect()->route('reviewAdoptionRequest')->with('success', 'Adoption request approved.');
        } else {
            return redirect()->route('reviewAdoptionRequest')->with('error', 'Invalid request or doge is not in a pending state.');
        }
    }

    public function declineAdopt(Request $request){
        $doge = Doge::find($request->id); 

        if ($doge && $doge->adoption_status === 'pending') {
            $doge->adoption_status = 'available'; 
            $doge->user_id = null; 
            dd($doge);
            $doge->save(); 
    
            return redirect()->route('reviewAdoptionRequest')->with('success', 'Adoption request declined.');
        } else {
            return redirect()->route('reviewAdoptionRequest')->with('error', 'Invalid request or doge is not in a pending state.');
        }
    }
}
