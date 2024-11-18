<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SafetyReport;

class SafetyReportController extends Controller
{
    public function index(SafetyReport $safetyReport){
        return view('posts.all_safety_reports')->with(['safetyReports'=>$safetyReport->get()]);
    }
}
