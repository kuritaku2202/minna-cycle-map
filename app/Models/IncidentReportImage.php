<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReportImage extends Model
{
    use HasFactory;
    public function incidentReport(){
        return $this->belongsTo(IncidentReport::class);
    }


    protected $fillable = [
        'incident_report_id',
        'image_url',
        'created_at',
        'updated_at',
    ];
}
