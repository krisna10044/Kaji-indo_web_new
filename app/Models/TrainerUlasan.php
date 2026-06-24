<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerUlasan extends Model
{
    protected $table = 'trainer_ulasan';

    protected $fillable = [
        'trainer_id',
        'user_id',
        'rating',
        'komentar',
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}