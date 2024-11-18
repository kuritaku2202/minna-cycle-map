<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;

class IncidentReportController extends Controller
{
    public function index(IncidentReport $incidentReport){
        return view('posts.all_incident_reports')->with(['incidentReports'=>$incidentReport->get()]);
    }
}
