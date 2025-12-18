<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeoController extends Controller
{
    public function reverse(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $format = $request->query('format', 'jsonv2');

        if (! $lat || ! $lon) {
            return response()->json(['error' => 'Missing lat/lon'], 400);
        }

        $url = 'https://nominatim.openstreetmap.org/reverse';

        $resp = Http::withHeaders([
            'User-Agent' => config('app.name') . ' (your-email@example.com)'
        ])->get($url, [
            'format' => $format,
            'lat' => $lat,
            'lon' => $lon,
        ]);

        return response($resp->body(), $resp->status())->header('Content-Type', $resp->header('Content-Type'));
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $format = $request->query('format', 'jsonv2');
        if (! $q) {
            return response()->json([], 200);
        }

        $url = 'https://nominatim.openstreetmap.org/search';

        $resp = Http::withHeaders([
            'User-Agent' => config('app.name') . ' (your-email@example.com)'
        ])->get($url, [
            'format' => $format,
            'q' => $q,
            'limit' => 5,
        ]);

        return response($resp->body(), $resp->status())->header('Content-Type', $resp->header('Content-Type'));
    }
}
