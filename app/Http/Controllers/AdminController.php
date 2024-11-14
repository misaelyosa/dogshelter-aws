<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function edit(Request $request){
        $user = Auth::user();
        if( $user->role === 'admin'){
            $doge = Doge::find($request->id);
            $doge->nama = $request->nama;
            $doge->dob = $request->dob;
            $doge->trait = $request->trait;
            $doge->jenis_kelamin = $request->jenis_kelamin;
            $doge->keterangan = $request->keterangan;
            $doge->vaccin_status = $request->vaccin_status;
            $doge->save();

            return redirect()->route("admin.index")->with("success", "ok");
        } else {
            return back()->withErrors('cannot edit');
        }
    }
}
