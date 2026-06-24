<?php
// app/Models/ProdukItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProdukItem;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukItem extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'produk_id', 'user_id', 'nama', 'kategori',
        'deskripsi', 'harga', 'stok', 'satuan', 'foto', 'is_unggulan',
    ];

    protected $casts = [
        'is_unggulan' => 'boolean',
        'harga'       => 'integer',
    ];

    // Relasi ke profil UMKM induknya
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor: format harga otomatis → "Rp 50.000"
    public function getHargaFormatAttribute(): string
    {
        if (!$this->harga || $this->harga == 0) return 'Harga nego';
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    
}