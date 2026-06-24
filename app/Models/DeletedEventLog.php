<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeletedEventLog extends Model
{
    protected $fillable = [
        'trainer_user_id',
        'event_id', 
        'event_title',
        'event_tanggal',
        'deleted_at_by_admin',
        'is_read',
    ];

    protected $casts = [
        'deleted_at_by_admin' => 'datetime',
        'event_tanggal'       => 'date',
        'is_read'             => 'boolean',
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_user_id');
    }
}