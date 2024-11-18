<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReportComment extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function incidentReport(){
        return $this->belongsTo(IncidentReport::class);
    }

    protected $fillable = [
        'user_id',
        'incident_report_id',
        'body',
        'created_at',
        'updated_at',
    ];
}
