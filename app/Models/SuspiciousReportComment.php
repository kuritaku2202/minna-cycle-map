<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspiciousReportComment extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function suspiciousReport(){
        return $this->belongsTo(SuspiciousReport::class);
    }


    protected $fillable = [
        'user_id',
        'suspicious_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
