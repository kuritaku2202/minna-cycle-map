<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SafetyReport extends Model
{
    use HasFactory;
    use SoftDeletes;


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

    public function securityStaff(){
        return $this->belongsTo(SecurityStaff::class);
    }

    public function securityCamera(){
        return $this->belongsTo(SecurityCamera::class);
    }

    protected $fillable = [
        'user_id',
        'spot_id',
        'date',
        'time_period_id',
        'description',
        'security_staff_id',
        'security_camera_id',
    ];
}
