<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function edit(Request $request){
        // dd('ballz');
        $user = Auth::user();
        if( $user->role === 'admin'){
            $doge = Doge::find($request->id);
            $doge->nama = $request->nama;
            $doge->dob = $request->dob;
            $doge->trait = $request->trait;
            $doge->jenis_kelamin = $request->jenis_kelamin;
            $doge->keterangan = $request->keterangan;
            $doge->vaccin_status = $request->vaccin_status;
            // dd($request->all());
            $doge->save();

            return redirect()->route("admin")->with("success", "Data updated successfully.");
        } else {
            return back()->withErrors('cannot edit');
        }
    }

    public function create(Request $request){
        $user = Auth::user();
        if ($user->role === 'admin') {
            $request->validate([
                'nama' => 'required|string|max:255',
                'dob' => 'required|date',
                'trait' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:male,female',
                'keterangan' => 'nullable|string',
                'vaccin_status' => 'required|string',
            ]);
            // dd($request->all());
            $doge = new Doge();
            $doge->nama = $request->nama;
            $doge->dob = $request->dob;
            $doge->trait = $request->trait;
            $doge->jenis_kelamin = $request->jenis_kelamin;
            $doge->keterangan = $request->keterangan;
            $doge->vaccin_status = $request->vaccin_status;
            $doge->save(); //insert db 

            return redirect()->route("admin")->with("success", "Doge added successfully.");
        } else {
            return back()->withErrors('You do not have permission to add a Doge.');
        }
    }

    public function delete($id){
        $doge = Doge::findorFail($id);
        $doge->delete();
        return redirect()->route("admin")->with("success", "Data deleted successfully.");
    }

    public function fetchEditDoge($id){
        $doge = Doge::findOrFail($id);
        return view('admin.edit', compact('doge'));
    }

    public function fetchUser(){
        $users = User::all();
        return view('admin.tableUser', compact('users'));
    }

    public function fetchAdopt($id){
        $doge = Doge::findOrFail($id);

        return view('user.adoptForm', compact('doges'));
    }
}
