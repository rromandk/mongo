<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        dd($request->route());
        // Verificar si es una respuesta de redirección después del login
        if (Auth::check() && $request->routeIs('*login*')) {
            $user = Auth::user();
        
            if ($user->role === 'admin') {
                return redirect()->to('/admin');
            } elseif ($user->role === 'user') {
                return redirect()->to('/user');
            }
        }
        return $response;
    }
}
