<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // <-- Import class Auth

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Modifikasi method handle untuk menerima parameter $role
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek jika user tidak login ATAU role-nya tidak sesuai dengan yang diizinkan
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Alihkan ke halaman dashboard standar
            return redirect('dashboard');
        }

        // Jika sesuai, lanjutkan permintaan ke tujuan
        return $next($request);
    }
}
