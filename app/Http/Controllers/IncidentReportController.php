<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;

class IncidentReportController extends Controller
{
//みんなの投稿画面、ホーム画面で使用
    public function getIncidentReports(){
        return IncidentReport::orderBy('created_at', 'desc')->take(3)->get();//最新の投稿３件を取得
    }
//種別投稿画面で使用
    public function index(IncidentReport $incidentReport){
        return view('posts.all_incident_reports')->with(['incidentReports'=>$incidentReport->get()]);
    }
}
