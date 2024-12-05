<?php

namespace App\Http\Controllers;

use App\Http\Requests\SafetyReportRequest;
use Illuminate\Http\Request;
use App\Models\SafetyReport;
use App\Models\TimePeriod;
use App\Models\Spot;
use App\Models\SecurityCamera;
use App\Models\SecurityStaff;

class SafetyReportController extends Controller
{
    public function getSafetyReports(){
        return SafetyReport::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function index(SafetyReport $safetyReport){
        return view('posts.all_safety_reports')->with(['safetyReports'=>$safetyReport->get()]);
    }

    // 投稿詳細画面
    public function show(SafetyReport $safetyReport){
        return view('posts.show_safety_report')->with(['post' => $safetyReport]);
    }

    public function edit(SafetyReport $safetyReport,TimePeriod $timePeriod){
        return view('posts.edit_safety_report')->with(['post' => $safetyReport, 'timePeriods' => $timePeriod->get()]);
    }

    public function update(SafetyReportRequest $request, SafetyReport $safetyReport){
        $imput = $request['safetyReport'];
        $safetyReport->fill($imput)->save();

        return redirect('/safety_reports/'.$safetyReport->id);
    }

    //投稿作成画面で使用
    public function chooseSafetySpot(){
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.choose_safety_spot')->with(['google_map_api_key'=>$google_map_api_key]);
    }
    public function create(TimePeriod $timePeriod, Request $request,Spot $spot){
        $input=$request['spot'];
        $spot->fill($input)->save();

        return view('posts.create_safety_report')->with(['timePeriods'=>$timePeriod->get(),'spot'=>$spot]);
    }
    public function store(SafetyReportRequest $request, SafetyReport $safetyReport){
        $input = $request['safetyReport'];
        $safetyReport -> fill($input)->save();
        return redirect('/safety_reports');
    }

    public function delete(SafetyReport $safetyReport){
        $safetyReport->delete();
        return redirect('/my_posts');
        }

}
