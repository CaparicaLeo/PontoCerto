<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Clock extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'description',
        'date',
    ];
}
