<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Faça login para continuar.');
        }
        
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
        }
        
        return $next($request);
    }
}
