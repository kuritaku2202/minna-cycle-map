<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyReportComment extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function safetyReport(){
        return $this->belongsTo(SafetyReport::class);
    }


    protected $fillable = [
        'user_id',
        'safety_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
