<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramUser extends Pivot
{
    protected $table = 'program_user';
    public $incrementing = true;
}