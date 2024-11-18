<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimePeriod extends Model
{
    use HasFactory;


    public function suspiciousReports(){
        return $this->hasMany(SuspiciousReport::class);
    }

    public function incidentReports(){
        return $this->hasMany(IncidentReport::class);
    }

    public function safetyReports(){
        return $this->hasMany(SafetyReport::class);
    }


    protected $fillable = [
        'time_slot',
    ];
}
