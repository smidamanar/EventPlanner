<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MS_RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

               
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('events.index');
                }
            }
        }

        return $next($request);
    }
}
