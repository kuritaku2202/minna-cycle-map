<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\SuspiciousReportController;
use App\Http\Controllers\SafetyReportController;
use App\Models\IncidentReport;
use App\Models\SuspiciousReport;
use App\Models\SafetyReport;

class PostsController extends Controller
{
    public function index(IncidentReportController $incidentReportController, SuspiciousReportController $suspiciousReportController, SafetyReportController $safetyReportController){
        //他のコントローラーからデータを取得
        $incidentReports = $incidentReportController-> getIncidentReports();
        $suspiciousReports = $suspiciousReportController->getSuspiciousReports();
        $safetyReports = $safetyReportController->getSafetyReports();

        return view('posts.all_posts', compact('incidentReports', 'suspiciousReports', 'safetyReports'));
    }

    public function choosePostType(){
        return view('posts.choose_post_type');
    }

    // public function index(IncidentReport $incidentReport, SuspiciousReport $suspiciousReport, SafetyReport $safetyReport){
    //     return view('posts.all_posts')->with(['incidentReports'=>$incidentReport->get()])->with(['suspiciousReports'=>$suspiciousReport->get()])->with(['safetyReports'=>$safetyReport->get()]);
    // }
}
