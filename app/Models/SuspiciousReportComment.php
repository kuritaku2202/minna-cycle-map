<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspiciousReportComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'suspicious_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
