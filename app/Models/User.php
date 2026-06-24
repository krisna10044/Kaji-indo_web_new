<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'location',
        'bio',
        'profile_photo_path',
        'is_umkm',
        'is_pembimbing',
        'umkm_expired_at',
        'pembimbing_expired_at',
        'role',
        'notif_email_pelatihan',
        'notif_email_umkm',
        'notif_email_halal',
        'notif_email_newsletter',
        'notif_browser',

        // Kolom tambahan untuk fitur pendaftaran Trainer
        'trainer_status',
        'trainer_applied_at',
        'rejection_reason',
        'nik',
        'npwp',
        'academic_degree',
        'experience',
        'ktp_scan',
        'bnsp_certificate',
        'white_bg_photo',
        'drive_link_documentation',
        'ijazah_file',
        'ijazah_type',
        'bukti_transfer',
        'gmaps_location',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_umkm' => 'boolean',
            'is_pembimbing' => 'boolean',
            'umkm_expired_at' => 'date',
            'pembimbing_expired_at' => 'date',
        ];
    }

    // ====================== HELPER METHODS ======================

    /**
     * Cek apakah user adalah UMKM (termasuk Pembimbing UMKM)
     */
    public function isUmkm(): bool
    {
        return $this->is_umkm === true || $this->role === 'umkm';
    }

    /**
     * Cek apakah user adalah Pembimbing umum (Pelatihan)
     */
    public function isPembimbing(): bool
    {
        return $this->is_pembimbing === true || $this->role === 'pembimbing';
    }

    /**
     * Cek apakah user adalah Admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user masih biasa (belum upgrade sama sekali)
     */
    public function isRegularUser(): bool
    {
        return $this->role === 'user' && !$this->is_umkm && !$this->is_pembimbing;
    }

    /**
     * Scope untuk query semua UMKM
     */
    public function scopeUmkm($query)
    {
        return $query->where(function ($q) {
            $q->where('is_umkm', true)
              ->orWhere('role', 'umkm');
        });
    }

    /**
     * Scope untuk query semua Pembimbing umum
     */
    public function scopePembimbing($query)
    {
        return $query->where(function ($q) {
            $q->where('is_pembimbing', true)
              ->orWhere('role', 'pembimbing');
        });
    }

    public function getUsernameAttribute()
    {
        return explode(' ', trim($this->name))[0];
    }

    // ====================== RELATIONSHIPS ======================
    public function trainerProfile()
{
    return $this->hasOne(\App\Models\Trainer::class, 'user_id', 'id');
}
    /**
     * Relasi Banyak-ke-Banyak (BelongsToMany) ke program pelatihan yang diikuti oleh UMKM
     */
    public function programs()
{
    return $this->belongsToMany(\App\Models\Program::class, 'program_user', 'user_id', 'program_id')
                ->using(\App\Pivots\ProgramUser::class)
                ->withPivot('status')
                ->withTimestamps();
}
}