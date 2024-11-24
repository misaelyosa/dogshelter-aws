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
}
