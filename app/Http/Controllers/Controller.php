<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\SuspiciousReportController;
use App\Http\Controllers\SafetyReportController;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // public function home(){

    //     // .envのAPIキーを変数へ
    //     $google_map_api_key = config('app.google_map_api_key');
    //     return view('posts.home')->with(['google_map_api_key' => $google_map_api_key]);

    // }

    // public function experiment(){

    //     // .envのAPIキーを変数へ
    //     $google_map_api_key = config('app.google_map_api_key');
    //     return view('posts.experiment')->with(['google_map_api_key' => $google_map_api_key]);

    // }

    public function home(IncidentReportController $incidentReportController, SuspiciousReportController $suspiciousReportController, SafetyReportController $safetyReportController){
        //他のコントローラーからデータを取得
        $incidentReports = $incidentReportController-> getIncidentReports();
        $suspiciousReports = $suspiciousReportController->getSuspiciousReports();
        $safetyReports = $safetyReportController->getSafetyReports();
        // .envのAPIキーを変数へ
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.home', compact('incidentReports', 'suspiciousReports', 'safetyReports', 'google_map_api_key'));

    }

    public function homeExperiment(IncidentReportController $incidentReportController, SuspiciousReportController $suspiciousReportController, SafetyReportController $safetyReportController){
        //他のコントローラーからデータを取得
        $incidentReports = $incidentReportController-> getIncidentReports();
        $suspiciousReports = $suspiciousReportController->getSuspiciousReports();
        $safetyReports = $safetyReportController->getSafetyReports();
        // .envのAPIキーを変数へ
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.home_experiment', compact('incidentReports', 'suspiciousReports', 'safetyReports', 'google_map_api_key'));

    }

    public function postExperiment(){

        // .envのAPIキーを変数へ
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.post_experiment')->with(['google_map_api_key' => $google_map_api_key]);

    }

}
