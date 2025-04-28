<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Supposons que tu as un champ 'is_admin' dans ta table 'users'
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request); // Si admin, on continue
        }

        abort(403, 'Accès refusé'); // Sinon, 403 Forbidden
    }
}
