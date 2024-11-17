<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReportComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'incident_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
