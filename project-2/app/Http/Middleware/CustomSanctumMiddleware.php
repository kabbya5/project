<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomSanctumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        if (!$userToken) {
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        if ($userToken->expires_at && Carbon::parse($userToken->expires_at)->isPast()) {
            return response()->json(['error' => 'Token Expired'], 401);
        }

        $user = \App\Models\User::find($userToken->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 401);
        }

        Auth::login($user);

        return $next($request);
    }
}
