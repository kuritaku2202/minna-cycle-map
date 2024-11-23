<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyReport extends Model
{
    use HasFactory;


    public function safetyReportComments(){
        return $this->hasMany(SafetyReportComment::class);
    }

    public function safetyReportImages(){
        return $this->hasMany(SafetyReportImage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function spot(){
        return $this->belongsTo(Spot::class);
    }

    public function timePeriod(){
        return $this->belongsTo(TimePeriod::class);
    }


    protected $fillable = [
        'user_id',
        'spot_id',
        'date',
        'time_period_id',
        'description',
        'security_staff',
        'security_camera',
    ];
}
