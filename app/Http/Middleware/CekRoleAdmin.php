<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada yang login?
        // 2. Cek apakah yang login punya role 'admin'?
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Silakan masuk
        }

        // Jika bukan admin, tendang ke halaman depan!
        return redirect('/');
    }
}