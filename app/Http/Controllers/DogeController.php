<?php

namespace App\Http\Controllers;

use App\Mail\AdoptionNoticeEmail;
use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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

        $userIds = $doges->pluck('user_id')->filter();
        $adopters = User::whereIn('id', $userIds)->get();
        // dd($doges, $adopters);

        return view('admin.reviewAdoptionRequest', compact('adopters', 'doges'));
    }

    public function acceptAdopt(Request $request){
        $doge = Doge::find($request->id); 

        if ($doge && $doge->adoption_status === 'pending') {
            $doge->adoption_status = 'adopted';
            // dd($doge);
            $doge->save(); 

            // Send email notification

            $adopter = User::find($doge->user_id); 
            // // dd($adopter->email);
            // if ($adopter && $adopter->email) {
            //     $response = Mail::to($adopter->email)->send(new AdoptionNoticeEmail($doge));
            // }
            // dd($response);
    
            return redirect()->back()->with('success', 'Adoption request approved.');
        } else {
            return redirect()->back()->with('error', 'Invalid request or doge is not in a pending state.');
        }
    }

    public function declineAdopt(Request $request){
        $doge = Doge::find($request->id); 

        if ($doge && $doge->adoption_status === 'pending') {
            $doge->adoption_status = 'available'; 
            $doge->user_id = null;
            $doge->pesan_adopsi = null; 
            // dd($doge);
            $doge->save(); 
    
            return redirect()->back()->with('success', 'Adoption request declined.');
        } else {
            return redirect()->back()->with('error', 'Invalid request or doge is not in a pending state.');
        }
    }

    public function testEmail(){
        $doge = Doge::find( 1);
        $adopter = User::find( 3); 
        $response = Mail::to($adopter->email)->send(new AdoptionNoticeEmail($doge));

        dd($response);

        return 'ballz';
    }
}
