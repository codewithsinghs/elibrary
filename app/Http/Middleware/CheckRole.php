<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // Dafault
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }


    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (Auth::check() && Auth::user()->hasRole($roles)) {
    //         return $next($request);
    //     }

    //     abort(403, 'Unauthorized');
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is logged in and has the specified roles
        if (Auth::check() && Auth::user()->hasAnyRole($roles)) {
            return $next($request);
        }

        // Redirect or abort as needed (in this case, aborting with a 403 status)
        abort(403, 'Unauthorized');
    }
}
