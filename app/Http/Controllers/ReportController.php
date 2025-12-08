<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function fetchReports()
    {
        $reports = Report::all();

        return view('admin.reports', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        print($request);
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:50',
            // 'nama' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time_found' => 'required',
            'description' => 'nullable|string',
            'doge_pic' => 'required|file|image|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            // Process uploaded file
            if ($request->hasFile('doge_pic')) {
                $file = $request->file('doge_pic');

                // Buat nama file aman
                $filename = 'report_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();

                // Simpan di storage/app/public/reports
                $path = $file->storeAs('public/reports', $filename);

                // Buat path yang disimpan di DB (public path)
                // Jika ingin simpan tanpa 'public/' prefix:
                $publicPath = 'reports/' . $filename;
            } else {
                $publicPath = null;
            }

            // Konversi time_found dari input datetime-local (format: yyyy-mm-ddThh:mm) -> datetime
            // Gunakan Carbon agar aman
            $timeFound = null;
            if ($request->filled('time_found')) {
                $timeFound = Carbon::parse($request->input('time_found'))->toDateTimeString();
            }

            // Simpan ke DB
            Report::create([
                'reporter_name' => $request->input('name'),
                'no_telp' => $request->input('no_telp'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'time_found' => $timeFound,
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'doge_pic' => $publicPath,
                'status' => 'pending', // default
            ]);

            return redirect()->route('home') // sesuaikan route tujuanmu
                ->with('success', 'Laporan berhasil dikirim. Terima kasih!');
        } catch (\Exception $e) {
            // Jika error, rollback otomatis karena create() single op; tapi kita tangkap dan informasikan
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
