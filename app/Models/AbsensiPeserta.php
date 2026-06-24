<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsensiPeserta extends Model
{
    protected $table = 'absensi_peserta';

    protected $fillable = [
      'pelatihan_id',
        'user_id',
        'ip_address',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'pelatihan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}