<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return redirect()->route('admin.login');
        }

        if (!$request->user()->isAdmin()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Hanya administrator yang dapat mengakses.',
                ], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin akses administrator.');
        }

        return $next($request);
    }
}
