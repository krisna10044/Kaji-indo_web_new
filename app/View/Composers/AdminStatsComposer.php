<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Program;
use App\Models\Produk;
use App\Models\Event;
use App\Models\User;

class AdminStatsComposer
{
    public function compose(View $view): void
    {
        $view->with('stats', [
            'pending_program' => Program::where('status', 'pending')->count(),
            'pending_produk'  => Produk::where('status', 'pending')->count(),
            'pending_event'   => Event::where('status', 'pending')->count(),
            'pending_trainer' => User::where('trainer_status', 'pending')->count(),
            'pending_mentor'  => User::where('mentor_status', 'pending')->count(),
            'total_users'     => User::count(),
        ]);
    }
}