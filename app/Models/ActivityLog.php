<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'label',
        'description',
        'ip_address',
        'user_agent',
        'is_success',
    ];

    protected $casts = [
        'is_success' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Simpan log aktivitas dengan mudah
     */
    public static function record(
        int $userId,
        string $type,
        string $label,
        string $description = '',
        bool $isSuccess = true
    ): self {
        return self::create([
            'user_id'    => $userId,
            'type'       => $type,
            'label'      => $label,
            'description'=> $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'is_success' => $isSuccess,
        ]);
    }

    /**
     * Ambil label browser + OS dari user agent
     */
    public function getDeviceLabel(): string
    {
        $ua = $this->user_agent ?? '';

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