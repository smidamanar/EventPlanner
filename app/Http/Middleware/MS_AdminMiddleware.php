<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MS_AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // User not logged in
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

        // User logged but not admin
        if ($request->user()->role !== 'admin') {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
