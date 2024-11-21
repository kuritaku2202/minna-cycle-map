<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\TimePeriod;

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
//投稿作成画面で使用
    public function create(TimePeriod $timePeriod){
        return view('posts.create_incident_report')->with(['timePeriods'=>$timePeriod->get()]);
    }

    public function store(Request $request, IncidentReport $incidentReport){
        $input = $request['incidentReport'];
        $incidentReport -> fill($input)->save();
        return redirect('/incidentReports');
    }
}
