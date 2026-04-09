<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekRoleAdmin {
    public function handle(Request $request, Closure $next): Response {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // PERBAIKAN: Tolak jika BUKAN admin dan BUKAN kasir
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'kasir') {
            return abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}