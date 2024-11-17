<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyReportComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'safety_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
