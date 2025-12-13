<?php

namespace App\Http\Controllers;

use App\Mail\AdoptionNoticeEmail;
use Illuminate\Http\Request;
use App\Models\Doge;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Report;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class DogeController extends Controller
{
    public function fetch()
    {
        $doges = Doge::with('shelter')->get();
        $shelters = \App\Models\Shelter::all();

        return view('home', compact('doges', 'shelters'));
    }

    public function fetchDogeAdmin()
    {
        // Group doges per shelter for admin overview
        $shelters = Shelter::with('dogs')->get();

        // Cluster reports to nearest shelter
        $reports = Report::all();
        $reportsByShelter = [];
        foreach ($reports as $report) {
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

        return view('admin.dashboard', compact('shelters', 'reportsByShelter'));
    }

    /**
     * Fetch doges for the shelter owner (only doges belonging to the owner's shelter)
     */
    public function fetchDogeOwner()
    {
        $user = Auth::user();
        $shelter = Shelter::where('user_id', $user->id)->first();

        if (!$shelter) {
            return redirect()->back()->with('error', 'No shelter linked to your account.');
        }

        $doges = Doge::where('shelter_id', $shelter->id)->get();

        return view('shelter.tableDoge', ['doges' => $doges]);
    }

    public function fetchAdoptionRequest()
    {
        $doges = Doge::whereNotNull('user_id')->get();

        $userIds = $doges->pluck('user_id')->filter();
        $adopters = User::whereIn('id', $userIds)->get();

        return view('admin.reviewAdoptionRequest', compact('adopters', 'doges'));
    }

    /**
     * Fetch adoption requests only for doges that belong to the shelter owner's shelter
     */
    public function fetchAdoptionRequestForOwner()
    {
        $user = Auth::user();
        $shelter = Shelter::where('user_id', $user->id)->first();

        if (!$shelter) {
            return redirect()->back()->with('error', 'No shelter linked to your account.');
        }

        $doges = Doge::where('shelter_id', $shelter->id)->whereNotNull('user_id')->get();

        $userIds = $doges->pluck('user_id')->filter();
        $adopters = User::whereIn('id', $userIds)->get();

        return view('admin.reviewAdoptionRequest', compact('adopters', 'doges'));
    }

    public function acceptAdopt(Request $request)
    {
        $doge = Doge::find($request->id);

        if ($doge && $doge->adoption_status === 'pending') {
            $doge->adoption_status = 'adopted';
            // dd($doge);
            $doge->save();

            // Send email notification

            $adopter = User::find($doge->user_id);
            // // dd($adopter->email);
            // if ($adopter && $adopter->email) {
            //     try {
            //         Mail::to($adopter->email)->send(new AdoptionNoticeEmail($doge));
            //     } catch (\Exception $e){
            //         return redirect()->back()->with('error', $e);
            //     }
            // }
            // dd($response);

            return redirect()->back()->with('success', 'Adoption request approved.');
        } else {
            return redirect()->back()->with('error', 'Invalid request or doge is not in a pending state.');
        }
    }

    public function declineAdopt(Request $request)
    {
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

    public function testEmail()
    {
        $doge = Doge::find(1);
        $adopter = User::find(3);
        // dd(config('mail.from'));
        // dd($adopter->email);
        try {
            Mail::to('misaelyosa101@gmail.com')->send(new AdoptionNoticeEmail($doge));
            dd('Email sent successfully!');
        } catch (\Exception $e) {
            dd('Email failed to send. Error: ' . $e->getMessage());
        }
    }
    public function fetchReport()
    {
        $doge = Doge::find(1);
        return view('user.dogReport', ['doge' => $doge]);
    }
}
