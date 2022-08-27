<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return response()->json([
                    "message" => "Unauthorized",
                    "results" => null,
                    "links" => [
                        "user" => "/admins/{id}"
                    ]
                    ], 401);
        }

        if (!$request->user()->hasRole($role)) {
            return response()->json([
                "message" => "Unauthorized",
                "results" => null,
                "links" => [
                    "user" => "/admins/{id}"
                ]
                ], 401);
        }
        return $next($request);
    }
}
