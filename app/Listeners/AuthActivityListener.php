<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;

class AuthActivityListener
{
    public function handleLogin(Login $event): void
    {
        ActivityLog::record(
            userId:      $event->user->id,
            type:        'login',
            label:       'Login berhasil',
            description: $this->getDevice(),
            isSuccess:   true
        );
    }

    public function handleLogout(Logout $event): void
    {
        if ($event->user) {
            ActivityLog::record(
                userId:      $event->user->id,
                type:        'logout',
                label:       'Logout',
                description: $this->getDevice(),
                isSuccess:   true
            );
        }
    }

    public function handleFailed(Failed $event): void
    {
        if ($event->user) {
            ActivityLog::record(
                userId:      $event->user->id,
                type:        'login',
                label:       'Percobaan login gagal',
                description: 'Password salah · ' . $this->getDevice(),
                isSuccess:   false
            );
        }
    }

    private function getDevice(): string
    {
        $ua = request()->userAgent() ?? '';

        $browser = 'Browser';
        if (str_contains($ua, 'Chrome') && !str_contains($ua, 'Edg'))  $browser = 'Chrome';
        elseif (str_contains($ua, 'Firefox'))  $browser = 'Firefox';
        elseif (str_contains($ua, 'Safari') && !str_contains($ua, 'Chrome'))  $browser = 'Safari';
        elseif (str_contains($ua, 'Edg'))  $browser = 'Edge';

        $os = 'Device';
        if (str_contains($ua, 'Windows'))     $os = 'Windows';
        elseif (str_contains($ua, 'Macintosh')) $os = 'macOS';
        elseif (str_contains($ua, 'iPhone'))  $os = 'iPhone';
        elseif (str_contains($ua, 'Android')) $os = 'Android';
        elseif (str_contains($ua, 'Linux'))   $os = 'Linux';

        return "$browser · $os";
    }
}