<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Définir un nom de cookie de session spécifique pour l'administration
        config(['session.cookie' => 'admin_session']);
        
        // Important : régénérer le jeton CSRF pour cette session
        if (!$request->session()->has('_token')) {
            $request->session()->regenerateToken();
        }
        
        return $next($request);
    }
}