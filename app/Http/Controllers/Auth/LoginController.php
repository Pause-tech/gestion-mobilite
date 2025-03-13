<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * 
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirection après connexion selon le rôle.
     */

     protected function authenticated(Request $request, $user)
     {
         if ($user->role === 'admin') {
             auth()->logout(); // Déconnecter toute autre session active
             auth('admin')->login($user); // Forcer la connexion en tant qu'admin
             return redirect()->route('admin.dashboard'); 
         }
     
         auth()->logout(); // Déconnecter toute autre session active
         auth('web')->login($user); // Forcer la connexion en tant qu'utilisateur normal
         return redirect()->route('home'); 
     }
     public function logout(Request $request)
     {
         // Déconnecter les sessions des deux guards
         auth('admin')->logout();
         auth('web')->logout();
     
         // Invalider et régénérer le token de session
         $request->session()->invalidate();
         $request->session()->regenerateToken();
     
         return redirect('/');
     }
         
     
    
}
