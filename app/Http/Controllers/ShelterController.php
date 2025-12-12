<?php

namespace App\Http\Controllers;

use App\Models\Doge;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index()
    {
        $doges = Doge::with('shelter')->get();
        $shelters = Shelter::all();

        return view('home', compact('doges', 'shelters'));
    }
}
