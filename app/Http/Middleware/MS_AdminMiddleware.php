<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MS_AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

       
        if ($request->user()->role !== 'admin') {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
