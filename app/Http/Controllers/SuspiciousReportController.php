<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SuspiciousReportRequest;
use App\Models\Spot;
use App\Models\SuspiciousReport;
use App\Models\TimePeriod;

class SuspiciousReportController extends Controller
{
    public function getSuspiciousReports(){
        return SuspiciousReport::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function index(SuspiciousReport $suspiciousReport){
        return view('posts.all_suspicious_reports')->with(['suspiciousReports'=>$suspiciousReport->get()]);
    }
    // 投稿詳細画面
    public function show(SuspiciousReport $suspiciousReport){
        return view('posts.show_suspicious_report')->with(['post' => $suspiciousReport]);
    }
    public function edit(SuspiciousReport $suspiciousReport,TimePeriod $timePeriod){
        return view('posts.edit_suspicious_report')->with(['post' => $suspiciousReport, 'timePeriods' => $timePeriod->get()]);
    }

    public function update(SuspiciousReportRequest $request, SuspiciousReport $suspiciousReport){
        $imput = $request['suspiciousReport'];
        $suspiciousReport->fill($imput)->save();

        return redirect('/suspicious_reports/'.$suspiciousReport->id);
    }

    //投稿作成画面で使用
    public function chooseSuspiciousSpot(){
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.choose_suspicious_spot')->with(['google_map_api_key'=>$google_map_api_key]);
    }
    public function create(TimePeriod $timePeriod, Request $request,Spot $spot){
        $input=$request['spot'];
        $spot->fill($input)->save();

        return view('posts.create_suspicious_report')->with(['timePeriods'=>$timePeriod->get(),'spot'=>$spot]);
    }
    public function store(SuspiciousReportRequest $request, SuspiciousReport $suspiciousReport){
        $input = $request['suspiciousReport'];
        $suspiciousReport -> fill($input)->save();
        return redirect('/suspicious_reports/'.$suspiciousReport->id);
    }

    public function delete(SuspiciousReport $suspiciousReport){
        $suspiciousReport->delete();
        return redirect('/my_posts');
        }

}
