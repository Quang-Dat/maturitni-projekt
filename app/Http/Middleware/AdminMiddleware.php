<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Předpokládáme, že máte sloupec 'role' v tabulce uživatelů, kde je hodnota 'admin' pro administrátory
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Pokud uživatel není admin, přesměrujte ho nebo vraťte odpověď s chybou
        return redirect('/')->with('error', 'Nemáte oprávnění pro přístup na tuto stránku.');
    }
}
