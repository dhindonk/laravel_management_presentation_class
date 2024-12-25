<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($request->user()->role !== $role) {
            if ($request->user()->role === 'admin') {
                return redirect()->route('admin.index')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
} 