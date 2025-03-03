<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local') || app()->environment('production')) {
            return $next($request);
        }

        $user = $request->user();

        // if (in_array($user->email, ['admin@admin']) || true) {
        //     return $next($request);
        // } else {
        //     abort(403);
        // }
        return $next($request);
    }
}
