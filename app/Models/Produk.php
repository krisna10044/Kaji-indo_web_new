<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'user_id',
    'nama',
    'kategori',
    'owner',
    'kontak',
    'nib',
    'id_tkm',
    'provinsi',        
    'kabupaten_kota',  
    'kecamatan',       
    'kelurahan',       
    'alamat',
    'deskripsi',
    'logo',            
    'foto_produk',
    'status',
    'mentor_id',
    'lat',
    'lng',
    'catatan_admin',
    'approved_at',
    'approved_by',
    'rejected_at',
    'rejected_by',
    'rejection_reason',
];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // ── Scopes ──────────────────────────────────
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApprovedThisMonth($query)
    {
        return $query->where('status', 'approved')
                     ->whereMonth('updated_at', now()->month)
                     ->whereYear('updated_at', now()->year);
    }

    // ── Relasi ──────────────────────────────────
    // Relasi ke user UMKM pemilik produk
    public function umkm(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function petaData()
{
    $data = \App\Models\Produk::whereNotNull('lat')
                ->whereNotNull('lng')
                ->where('status', 'approved')
                ->get(['id', 'nama', 'alamat', 'lat', 'lng', 'foto']);

    return response()->json(['data' => $data]);
}

public function mentor()
{
    // Menghubungkan kolom mentor_id ke tabel mentor (Model Mentor)
    return $this->belongsTo(Mentor::class, 'mentor_id');
}



public function items()
{
    return $this->hasMany(ProdukItem::class, 'produk_id');
}

// Relasi baru: banyak mentor (many-to-many)
public function mentors()
{
    return $this->belongsToMany(Mentor::class, 'produk_mentor', 'produk_id', 'mentor_id')
                ->withTimestamps();
}

public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}
}