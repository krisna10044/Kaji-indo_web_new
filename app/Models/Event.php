<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id',
        'judul',
        'tipe',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'kapasitas',
        'biaya',
        'deskripsi',
        'gambar',
        'status',         // pending | approved | rejected
        'catatan_admin',
        'approved_at',
        'approved_by',
        'rejected_at',
        'rejected_by',
        'deleted_by_admin_at',
        'deleted_by_admin_id',
        'deleted_reason',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'approved_at'  => 'datetime',
        'rejected_at'  => 'datetime',
        'deleted_by_admin_at' => 'datetime',
    ];

    // ── Relasi ────────────────────────────────────────────────────
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function deletedByAdmin()
{
    return $this->belongsTo(User::class, 'deleted_by_admin_id');
}

protected static function booted(): void
{
    static::addGlobalScope('not_deleted_by_admin', function ($query) {
        $query->whereNull('deleted_by_admin_at');
    });
}

    // ── Accessor: biaya tampil "Gratis" jika kosong / 0 ──────────
    public function getBiayaLabelAttribute(): string
    {
        if (empty($this->biaya) || $this->biaya == '0' || strtolower($this->biaya) === 'gratis') {
            return 'Gratis';
        }
        return $this->biaya;
    }

    // ── Accessor: format waktu "08.00 – 17.00 WIB" ───────────────
    public function getJamAttribute(): string
    {
        if ($this->waktu_mulai && $this->waktu_selesai) {
            $mulai   = \Carbon\Carbon::createFromFormat('H:i:s', $this->waktu_mulai)->format('H.i');
            $selesai = \Carbon\Carbon::createFromFormat('H:i:s', $this->waktu_selesai)->format('H.i');
            return $mulai . ' – ' . $selesai . ' WIB';
        }
        return '-';
    }
}