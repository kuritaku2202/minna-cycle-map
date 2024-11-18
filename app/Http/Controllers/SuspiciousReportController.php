<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuspiciousReport;

class SuspiciousReportController extends Controller
{
    public function getSuspiciousReports(){
        return SuspiciousReport::orderBy('created_at', 'desc')->take(3)->get();
    }
    public function index(SuspiciousReport $suspiciousReport){
        return view('posts.all_suspicious_reports')->with(['suspiciousReports'=>$suspiciousReport->get()]);
    }
}
