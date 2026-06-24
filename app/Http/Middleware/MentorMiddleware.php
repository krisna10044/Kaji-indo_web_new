<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Mentor;

class MentorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $mentor = Mentor::where('user_id', $user->id)->latest()->first();

        if (!$mentor) {
            return redirect()->route('profile')
                ->with('error', 'Anda belum terdaftar sebagai mentor.');
        }

        return $next($request);
    }
}
