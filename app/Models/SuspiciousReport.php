<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuspiciousReport extends Model
{
    use HasFactory;


    public function suspiciousReportComments(){
        return $this->hasMany(SuspiciousReportComment::class);
    }

    public function suspiciousReportImages(){
        return $this->hasMany(SuspiciousReportImage::class);
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
    ];
}
