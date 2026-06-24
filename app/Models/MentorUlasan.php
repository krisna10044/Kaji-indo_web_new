<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorUlasan extends Model
{
    protected $table = 'mentor_ulasan';

    protected $fillable = [
        'mentor_id',
        'user_id',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Mentor yang diulas
     */
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    /**
     * User UMKM yang memberikan ulasan
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}