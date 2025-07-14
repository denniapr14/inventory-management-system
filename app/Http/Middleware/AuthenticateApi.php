<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        // Check session authentication
        if (Auth::check()) {
            return $next($request);
        }

        // Check API token authentication
        if ($request->bearerToken()) {
            try {
                if (Auth::guard('sanctum')->check()) {
                    return $next($request);
                }
            } catch (\Exception $e) {
                // Token invalid
            }
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }
}
