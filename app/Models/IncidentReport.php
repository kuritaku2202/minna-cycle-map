<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentReport extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function incidentReportComments(){
        return $this->hasMany(IncidentReportComment::class);
    }

    public function incidentReportImages(){
        return $this->hasMany(IncidentReportImage::class);
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
