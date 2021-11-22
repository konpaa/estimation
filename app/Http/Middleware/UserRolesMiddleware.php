<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRolesMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->user() || !collect($roles)->contains(auth()->user()->role)) {
            return new JsonResponse(['error' => 'Sorry! You are not authorized to perform this action.'], 403);
        }

        return $next($request);
    }
}
