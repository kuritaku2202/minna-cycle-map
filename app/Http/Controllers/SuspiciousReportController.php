<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    //投稿作成画面で使用
    public function create(TimePeriod $timePeriod){
        return view('posts.create_suspicious_report')->with(['timePeriods'=>$timePeriod->get()]);
    }
    public function store(Request $request, SuspiciousReport $suspiciousReport){
        $input = $request['suspiciousReport'];
        $suspiciousReport -> fill($input)->save();
        return redirect('/suspicious_reports');
    }
}
