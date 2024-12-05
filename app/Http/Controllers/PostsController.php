<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function myIndex(IncidentReportController $incidentReportController, SuspiciousReportController $suspiciousReportController, SafetyReportController $safetyReportController){
        //他のコントローラーから自分の投稿に関するデータを取得
        $user = Auth::user();

        // $incidentReports = $incidentReportController-> getIncidentReports();
        // $suspiciousReports = $suspiciousReportController->getSuspiciousReports();
        // $safetyReports = $safetyReportController->getSafetyReports();

        $myIncidentReports = $user->incidentReports;
        $mySuspiciousReports = $user->suspiciousReports;
        $mySafetyReports = $user->safetyReports;

        // .envのAPIキーを変数へ
        $api_key = config('app.api_key');

        // dd($mySafetyReports);
        return view('posts.my_posts', compact('myIncidentReports', 'mySuspiciousReports', 'mySafetyReports','api_key'));
    }


    public function choosePostType(){
        return view('posts.choose_post_type');
    }

    // public function index(IncidentReport $incidentReport, SuspiciousReport $suspiciousReport, SafetyReport $safetyReport){
    //     return view('posts.all_posts')->with(['incidentReports'=>$incidentReport->get()])->with(['suspiciousReports'=>$suspiciousReport->get()])->with(['safetyReports'=>$safetyReport->get()]);
    // }
}
