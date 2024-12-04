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

    public function show(IncidentReport $post){
        return view('posts.show_incident_report')->with(['post' => $post]);
    }

    //投稿作成画面で使用
    public function chooseIncidentSpot(){
        $api_key = config('app.api_key');
        return view('posts.choose_incident_spot')->with(['api_key'=>$api_key]);
    }
    public function create(TimePeriod $timePeriod,Request $request, Spot $spot){
        // $lat = $request->query('lat');// GETパラメータ "lat" の値
        // $lng = $request->query('lng');// GETパラメータ "lng" の値
        $input=$request['spot'];
        // $spot->longitude = $lng;
        $spot->fill($input)->save();

        return view('posts.create_incident_report')->with(['timePeriods'=>$timePeriod->get(),'spot'=>$spot]);
    }

    public function store(Request $request, IncidentReport $incidentReport){
        $input = $request['incidentReport'];
        $incidentReport -> fill($input)->save();
        return redirect('/incident_reports');
    }

}
