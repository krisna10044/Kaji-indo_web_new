<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            session()->flash('auth_required', 'Kamu harus login atau daftar akun terlebih dahulu untuk mengakses halaman tersebut.');
            return route('login');
        }
        return null;
    }
}