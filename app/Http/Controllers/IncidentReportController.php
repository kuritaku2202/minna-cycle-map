<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\TimePeriod;
use App\Models\Spot;

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

// 投稿詳細画面
    public function show(IncidentReport $incidentReport){
        return view('posts.show_incident_report')->with(['post' => $incidentReport]);
    }

    public function edit(IncidentReport $incidentReport,TimePeriod $timePeriod){
        return view('posts.edit_incident_report')->with(['post' => $incidentReport, 'timePeriods' => $timePeriod->get()]);
    }

    public function update(Request $request, IncidentReport $incidentReport){
        $imput = $request['incidentReport'];
        $incidentReport->fill($imput)->save();

        return redirect('/incident_reports/'.$incidentReport->id);
    }

    //投稿作成画面で使用
    public function chooseIncidentSpot(){
        $api_key = config('app.api_key');
        return view('posts.choose_incident_spot')->with(['api_key'=>$api_key]);
    }
    public function create(TimePeriod $timePeriod,Request $request, Spot $spot){
        $input=$request['spot'];
        $spot->fill($input)->save();

        return view('posts.create_incident_report')->with(['timePeriods'=>$timePeriod->get(),'spot'=>$spot]);
    }

    public function store(Request $request, IncidentReport $incidentReport){
        $input = $request['incidentReport'];
        $incidentReport -> fill($input)->save();
        return redirect('/incident_reports/'.$incidentReport->id);
    }


}
