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

        if (Auth::user()->role !== 'admin') {
            return abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}