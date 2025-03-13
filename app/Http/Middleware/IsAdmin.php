<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Si l'utilisateur n'est pas admin, le rediriger ailleurs (par exemple, vers /mobilite)
        return redirect('/mobilite')->with('error', 'Accès refusé. Vous devez être administrateur.');
    }
}
