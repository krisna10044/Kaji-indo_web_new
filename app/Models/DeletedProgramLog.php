<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeletedProgramLog extends Model
{
    protected $fillable = [
        "trainer_user_id",
        'program_id', 
        "program_title",
        "program_tipe",
        "is_read",
        "deleted_at_by_admin",
    ];

    protected $casts = [
        "deleted_at_by_admin" => "datetime",
        "is_read"             => "boolean",
    ];

    public function trainer()
    {
        return $this->belongsTo(User::class, "trainer_user_id");
    }
}