<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafetyReport;
use App\Models\TimePeriod;
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
    //投稿作成画面で使用
    public function create(TimePeriod $timePeriod){
        return view('posts.create_safety_report')->with(['timePeriods'=>$timePeriod->get()]);
    }
    public function store(Request $request, SafetyReport $safetyReport){
        $input = $request['safetyReport'];
        $safetyReport -> fill($input)->save();
        return redirect('/safety_reports');
    }
}
