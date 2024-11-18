<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspiciousReportImage extends Model
{
    use HasFactory;


    public function suspiciousReport(){
        return $this->belongsTo(SuspiciousReport::class);
    }


    protected $fillable = [
        'suspicious_report_id',
        'image_url',
        'created_at',
        'updated_at',
    ];
}
