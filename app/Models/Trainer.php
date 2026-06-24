<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $table = 'trainer';

    protected $fillable = [
        // Relasi
        'user_id',

        // Identitas
        'nama',
        'full_name',
        'email',
        'phone',
        'no_hp',

        // Dokumen & Akademik
        'nik',
        'npwp',
        'academic_degree',
        'ijazah_type',
        'ijazah_file',

        // Profil
        'bio',
        'foto',
        'bidang',
        'deskripsi',
        'keahlian',
        'experience',
        'sosmed',
        'displayed_bidang',

        // Lokasi
        'lokasi',
        'gmaps_location',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',

        // Dokumen Upload
        'ktp_scan',
        'bnsp_certificate',
        'white_bg_photo',
        'bukti_transfer',
        'drive_link_documentation',

        // Status Pendaftaran
        'status',
        'rejection_reason',
        'reviewed_at',
        'agree_terms',
        'applied_at',

    ];

    protected $casts = [
        'agree_terms' => 'boolean',
        'reviewed_at' => 'datetime',
        'applied_at'  => 'datetime',
        'sosmed' => 'array',
    ];

    // ═══════════════════════════════════════════
    // RELASI
    // ═══════════════════════════════════════════

    /**
     * User pemilik akun trainer ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ulasan yang diterima trainer ini.
     * (Relasi lama dipertahankan)
     */
    public function ulasan(): HasMany
    {
        return $this->hasMany(UlasanPembimbing::class, 'pembimbing_id');
    }

   // ═══════════════════════════════════════════
// SCOPES
// ═══════════════════════════════════════════

public function scopeApproved($query)
{
    return $query->where('status', 'approved');
}

public function scopePending($query)
{
    return $query->where('status', 'pending');
}

public function scopeRejected($query)
{
    return $query->where('status', 'rejected');
}

public function scopeHalal($query)
{
    $keywords = ['Penyelia Halal', 'P3H', 'PPH', 'Fasilitator'];

    return $query->where(function ($q) use ($keywords) {
        foreach ($keywords as $kw) {
            $q->orWhere('keahlian', 'LIKE', "%{$kw}%");
        }
    });
}

// ═══════════════════════════════════════════
// HELPERS
// ═══════════════════════════════════════════

public function isApproved(): bool
{
    return $this->status === 'approved';
}

public function isPending(): bool
{
    return $this->status === 'pending';
}

public function isRejected(): bool
{
    return $this->status === 'rejected';
}

public function getKeahlianArrayAttribute(): array
{
    if (empty($this->keahlian)) return [];
    return array_map('trim', explode(',', $this->keahlian));
}

public function getNamaLengkapAttribute(): string
{
    return $this->academic_degree ?? '';
}
}

