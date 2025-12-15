<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shelter;

class EnsureShelterVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Non-shelter owners unaffected
        if ($user->role !== 'shelter_owner') {
            return $next($request);
        }

        $shelter = Shelter::where('user_id', $user->id)->first();
        if (!$shelter || !$shelter->is_verified) {
            // If not verified, redirect to verification form
            return redirect()->route('shelter.verify.form')->withErrors('Your shelter account is not yet verified by admin.');
        }

        return $next($request);
    }
}
