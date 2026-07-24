<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Sudah login tapi bukan admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('landing')
                ->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}