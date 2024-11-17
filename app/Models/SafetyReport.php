<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spot_id',
        'date',
        'time_period_id',
        'description',
    ];
}
