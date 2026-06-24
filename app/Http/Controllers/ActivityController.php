<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = ActivityLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan tipe
        if ($request->filled('filter') && $request->filter !== 'semua') {
            $query->where('type', $request->filter);
        }

        // Hanya 30 hari terakhir
        $query->where('created_at', '>=', now()->subDays(30));

        $activities = $query->paginate(15)->withQueryString();

        // Statistik
        $stats = [
            'total_login'   => ActivityLog::where('user_id', $user->id)
                                ->where('type', 'login')
                                ->where('is_success', true)
                                ->count(),
            'total_profile' => ActivityLog::where('user_id', $user->id)
                                ->whereIn('type', ['profile', 'photo', 'password'])
                                ->count(),
            'days_joined'   => (int) $user->created_at->diffInDays(now()),
        ];

        return view('profile.activity', compact('activities', 'stats'));
    }
}