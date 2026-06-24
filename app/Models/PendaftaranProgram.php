<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranProgram extends Model
{
    protected $fillable = [
        'user_id', 'program_id',
        'nama_lengkap', 'email', 'no_hp', 'alamat',
        'status', 'bukti_pembayaran', 'catatan_admin',
        'alasan_penolakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class, 'program_id');
    }

    public function isBerbayar(): bool
    {
        return !empty($this->program->biaya) && $this->program->biaya !== 'Gratis' && $this->program->biaya != 0;
    }
}