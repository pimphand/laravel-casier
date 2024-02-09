<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekan apakah pengguna autentikasi dan aktif
        if (Auth::check() && Auth::user()->is_active) {
            // Pengecekan token Sanctum
            if ($request->user()->currentAccessToken() === null) {
                return response()->json(['error' => 'Unauthorized. Missing Sanctum token.'], 401);
            }

            return $next($request);
        }

        // Jika pengguna tidak autentikasi atau tidak aktif
        return response()->json(['error' => 'Unauthorized. User is not authenticated or not active.'], 401);
    }
}
