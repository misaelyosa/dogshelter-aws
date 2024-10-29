<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;

class DogeController extends Controller
{
    public function fetch(){
        $doges = Doge::all();

        return view('home', ['doges' => $doges]);
    }

    public function fetchDogeAdmin(){
        $doges = Doge::all();

        return view('admin/index', ['doges' => $doges]);
    }
}
