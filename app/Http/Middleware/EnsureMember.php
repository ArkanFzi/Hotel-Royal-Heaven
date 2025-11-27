<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureMember
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard.index')->with('error', 'Admin tidak dapat mengakses halaman member.');
        }

        return $next($request);
    }
}
