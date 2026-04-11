<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleKasir
{
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan jika user sudah login dan memiliki role 'kasir'
        if (Auth::check() && Auth::user()->role == 'kasir') {
            return $next($request);
        }

        // Tendang ke halaman awal jika selain kasir mencoba masuk
        return redirect('/')->with('error', 'Akses ditolak! Halaman ini khusus Kasir.');
    }
}