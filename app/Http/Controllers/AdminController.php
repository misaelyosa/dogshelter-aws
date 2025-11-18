<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function edit(Request $request)
    {
        // dd('ballz');
        $user = Auth::user();
        if ($user->role === 'admin') {
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

    public function create(Request $request)
    {
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

    public function delete($id)
    {
        $doge = Doge::findorFail($id);
        $doge->delete();
        return redirect()->route("admin")->with("success", "Data deleted successfully.");
    }

    public function fetchEditDoge($id)
    {
        $doge = Doge::findOrFail($id);
        return view('admin.edit', compact('doge'));
    }

    public function fetchUser()
    {
        $admins = User::where('role', 'admin')
            ->with(['adoptedDoge' => function ($query) {
                $query->select('id', 'user_id', 'nama');
            }])
            ->orderBy('name')
            ->get();

        $users = User::where('role', 'user')
            ->with(['adoptedDoge' => function ($query) {
                $query->select('id', 'user_id', 'nama');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.tableUser', compact('admins', 'users'));
    }

    public function banUser($id)
    {
        $user = User::findorFail($id);

        if ($user->ban_status === 0) {
            $user->ban_status = 1;
            $user->save();
            return redirect()->back()->with('success', 'user successfully banned');
        } else {
            $user->ban_status = 0;
            $user->save();
            return redirect()->back()->with('success', 'user successfully unbanned');
        }
    }
    public function fetchReports(Request $request)
    {
        // optional: filter by status ? q ? order
        $reports = Report::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.reports', compact('reports'));
    }

    // Show single report detail
    public function showReport($id)
    {
        $report = Report::findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

    // Accept report (update status)
    public function acceptReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'accepted';
        $report->save();

        return redirect()->route('reportsAdmin')->with('success', 'Report #' . $report->id . ' accepted.');
    }

    // Decline report (update status)
    public function declineReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'declined';
        $report->save();

        return redirect()->route('reportsAdmin')->with('success', 'Report #' . $report->id . ' declined.');
    }
}
