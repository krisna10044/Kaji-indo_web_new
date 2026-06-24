<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulProgress extends Model
{
    protected $table = 'modul_progress';

    protected $fillable = [
        'user_id',
        'program_id',
        'modul_id',
        'status',
        'selesai_at',
    ];

    protected $casts = [
        'selesai_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modul()
    {
        return $this->belongsTo(Program::class, 'modul_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}