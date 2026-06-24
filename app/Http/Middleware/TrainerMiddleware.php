<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrainerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->trainer_status !== 'approved') {
            abort(403, 'Akses ditolak. Anda belum diverifikasi sebagai Trainer.');
        }

        return $next($request);
    }
}