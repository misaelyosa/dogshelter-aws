<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\Report;
use App\Models\User;
use App\Models\Shelter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\OwnerShelterStatus;

class AdminController extends Controller
{
    public function edit(Request $request)
    {
        // dd('ballz');
        $user = Auth::user();
        $doge = Doge::find($request->id);

        if (!$doge) {
            return back()->withErrors('Doge not found');
        }

        // Admin can edit any doge
        if ($user->role === 'admin') {
            // proceed
        } elseif ($user->role === 'shelter_owner') {
            $shelter = Shelter::where('user_id', $user->id)->first();
            if (!$shelter || $doge->shelter_id !== $shelter->id) {
                return back()->withErrors('You do not have permission to edit this doge.');
            }
        } else {
            return back()->withErrors('cannot edit');
        }

        $doge->nama = $request->nama;
        $doge->dob = $request->dob;
        $doge->trait = $request->trait;
        $doge->jenis_kelamin = $request->jenis_kelamin;
        $doge->keterangan = $request->keterangan;
        $doge->vaccin_status = $request->vaccin_status;
        $doge->save();

        if ($user->role === 'admin') {
            return redirect()->route("fetchuser")->with("success", "Data updated successfully.");
        }

        return redirect()->route("shelter.dashboard")->with("success", "Data updated successfully.");
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'shelter_owner') {
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
            // If shelter owner, associate doge with their shelter
            if ($user->role === 'shelter_owner') {
                $shelter = Shelter::where('user_id', $user->id)->first();
                if ($shelter) {
                    $doge->shelter_id = $shelter->id;
                }
            }
            $doge->save(); //insert db 

            // Notify all users about new dog
            try {
                $users = User::where('role', 'user')->pluck('email')->filter();
                foreach ($users as $email) {
                    Mail::to($email)->send(new \App\Mail\NewDogeAdded($doge));
                }
            } catch (\Exception $e) {}

            if ($user->role === 'admin') {
                return redirect()->route("fetchuser")->with("success", "Doge added successfully.");
            }

            return redirect()->route("shelter.dashboard")->with("success", "Doge added successfully.");
        } else {
            return back()->withErrors('You do not have permission to add a Doge.');
        }
    }

    public function delete($id)
    {
        $user = Auth::user();
        $doge = Doge::findorFail($id);

        if ($user->role === 'admin') {
            $doge->delete();
            return redirect()->route("fetchuser")->with("success", "Data deleted successfully.");
        }

        if ($user->role === 'shelter_owner') {
            $shelter = Shelter::where('user_id', $user->id)->first();
            if (!$shelter || $doge->shelter_id !== $shelter->id) {
                return back()->withErrors('You do not have permission to delete this doge.');
            }

            $doge->delete();
            return redirect()->route("shelter.dashboard")->with("success", "Data deleted successfully.");
        }

        return back()->withErrors('You do not have permission to delete this doge.');
    }

    public function fetchEditDoge($id)
    {
        $user = Auth::user();
        $doge = Doge::findOrFail($id);

        if ($user->role === 'admin') {
            return view('admin.edit', compact('doge'));
        }

        if ($user->role === 'shelter_owner') {
            $shelter = Shelter::where('user_id', $user->id)->first();
            if (!$shelter || $doge->shelter_id !== $shelter->id) {
                return back()->withErrors('You do not have permission to edit this doge.');
            }

            return view('admin.edit', compact('doge'));
        }

        return back()->withErrors('You do not have permission to edit this doge.');
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

        $shelterOwners = User::where('role', 'shelter_owner')
            ->with(['adoptedDoge' => function ($query) {
                $query->select('id', 'user_id', 'nama');
            }])
            ->orderBy('name')
            ->get();

        return view('admin.tableUser', compact('admins', 'users', 'shelterOwners'));
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

    public function deleteUser(Request $request, $id)
    {
        $current = Auth::user();
        $user = User::findOrFail($id);

        if ($user->id === $current->id) {
            return redirect()->back()->with('error', 'You cannot delete yourself.');
        }

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot delete another admin.');
        }

        // perform deletion
        try {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
    public function fetchReports(Request $request)
    {
        // optional: filter by status ? q ? order
        $reports = Report::orderBy('created_at', 'desc')->paginate(15);

        // For clustering: load shelters and cluster all reports to nearest shelter
        $shelters = Shelter::all();
        $allReports = Report::all();
        $reportsByShelter = [];

        foreach ($allReports as $report) {
            $closestShelterId = null;
            $closestDist = null;
            if ($report->latitude !== null && $report->longitude !== null) {
                foreach ($shelters as $shelter) {
                    if ($shelter->latitude === null || $shelter->longitude === null) continue;
                    $dx = $shelter->latitude - $report->latitude;
                    $dy = $shelter->longitude - $report->longitude;
                    $dist = ($dx * $dx) + ($dy * $dy);
                    if ($closestDist === null || $dist < $closestDist) {
                        $closestDist = $dist;
                        $closestShelterId = $shelter->id;
                    }
                }
            }

            $key = $closestShelterId ?? 'unassigned';
            if (!isset($reportsByShelter[$key])) {
                $reportsByShelter[$key] = [];
            }
            $reportsByShelter[$key][] = $report;
        }

        // If current user is a shelter owner, only return reports assigned to their shelter
        $user = Auth::user();
        if ($user && $user->role === 'shelter_owner') {
            $shelter = Shelter::where('user_id', $user->id)->first();
            $ownerReports = [];
            if ($shelter) {
                $ownerReports = $reportsByShelter[$shelter->id] ?? [];
            }

            // use a collection for owner (no pagination)
            $reports = collect($ownerReports);
        }

        return view('admin.reports', compact('reports', 'shelters', 'reportsByShelter'));
    }

    // Show single report detail
    public function showReport($id)
    {
        $report = Report::findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

    // List shelter verification requests (pending)
    public function listPendingShelters()
    {
        $pending = Shelter::where('is_verified', false)->orderBy('created_at', 'desc')->get();
        return view('admin.shelter_verifications', compact('pending'));
    }

    // Show single shelter verification detail
    public function showShelterVerification($id)
    {
        $shelter = Shelter::findOrFail($id);
        return view('admin.shelter_verification_show', compact('shelter'));
    }

    // Accept shelter verification
    public function acceptShelter(Request $request, $id)
    {
        $shelter = Shelter::findOrFail($id);
        $shelter->is_verified = true;
        $shelter->save();

        // Notify owner
        try {
            if ($shelter->user_id) {
                Mail::to($shelter->user->email)->send(new OwnerShelterStatus($shelter, true));
            }
        } catch (\Exception $e) {}

        return redirect()->route('admin.shelter_verifications')->with('success', 'Shelter #' . $shelter->id . ' verified.');
    }

    // Decline shelter verification
    public function declineShelter(Request $request, $id)
    {
        $shelter = Shelter::findOrFail($id);
        // Keep record but not verified
        $shelter->is_verified = false;
        $shelter->save();

        // Notify owner
        try {
            if ($shelter->user_id) {
                Mail::to($shelter->user->email)->send(new OwnerShelterStatus($shelter, false));
            }
        } catch (\Exception $e) {}

        return redirect()->route('admin.shelter_verifications')->with('success', 'Shelter #' . $shelter->id . ' declined.');
    }

    // Accept report (update status)
    public function acceptReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'accepted';
        $report->save();

        $user = Auth::user();
        if ($user && $user->role === 'shelter_owner') {
            return redirect()->route('reportsShelter')->with('success', 'Report #' . $report->id . ' accepted.');
        }

        // fallback for admin or others
        if (
            Route::has('reportsAdmin')
        ) {
            return redirect()->route('reportsAdmin')->with('success', 'Report #' . $report->id . ' accepted.');
        }

        return redirect()->back()->with('success', 'Report #' . $report->id . ' accepted.');
    }

    // Decline report (update status)
    public function declineReport(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->status = 'declined';
        $report->save();

        $user = Auth::user();
        if ($user && $user->role === 'shelter_owner') {
            return redirect()->route('reportsShelter')->with('success', 'Report #' . $report->id . ' declined.');
        }

        // fallback for admin or others
        if (
            Route::has('reportsAdmin')
        ) {
            return redirect()->route('reportsAdmin')->with('success', 'Report #' . $report->id . ' declined.');
        }

        return redirect()->back()->with('success', 'Report #' . $report->id . ' declined.');
    }
}
