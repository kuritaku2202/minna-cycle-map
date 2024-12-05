<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SuspiciousReportRequest;
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
    public function create(TimePeriod $timePeriod){
        return view('posts.create_suspicious_report')->with(['timePeriods'=>$timePeriod->get()]);
    }
    public function store(SuspiciousReportRequest $request, SuspiciousReport $suspiciousReport){
        $input = $request['suspiciousReport'];
        $suspiciousReport -> fill($input)->save();
        return redirect('/suspicious_reports');
    }

    public function delete(SuspiciousReport $suspiciousReport){
        $suspiciousReport->delete();
        return redirect('/my_posts');
        }

}
