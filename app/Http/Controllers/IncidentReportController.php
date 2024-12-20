<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\IncidentReportRequest;
use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\IncidentReportImage;
use App\Models\TimePeriod;
use App\Models\Spot;
use Cloudinary;

class IncidentReportController extends Controller
{
//みんなの投稿画面、ホーム画面で使用
    public function getIncidentReports(){
        return IncidentReport::orderBy('created_at', 'desc')->take(3)->get();//最新の投稿３件を取得
    }
//種別投稿画面で使用
    public function index(IncidentReport $incidentReport){
        return view('posts.all_incident_reports')->with(['incidentReports'=>$incidentReport->get()]);
    }

// 投稿詳細画面
    public function show(IncidentReport $incidentReport){
        return view('posts.show_incident_report')->with(['post' => $incidentReport]);
    }

    public function edit(IncidentReport $incidentReport,TimePeriod $timePeriod){
        return view('posts.edit_incident_report')->with(['post' => $incidentReport, 'timePeriods' => $timePeriod->get()]);
    }

    public function update(IncidentReportRequest $request, IncidentReport $incidentReport){
        $imput = $request['incidentReport'];
        $incidentReport->fill($imput)->save();

        return redirect('/incident_reports/'.$incidentReport->id);
    }

    //投稿作成画面で使用
    public function chooseIncidentSpot(){
        $google_map_api_key = config('app.google_map_api_key');
        return view('posts.choose_incident_spot')->with(['google_map_api_key'=>$google_map_api_key]);
    }
    public function create(TimePeriod $timePeriod,Request $request, Spot $spot){
        $input=$request['spot'];
        $spot->fill($input)->save();

        return view('posts.create_incident_report')->with(['timePeriods'=>$timePeriod->get(),'spot'=>$spot]);
    }

    public function store(incidentReportRequest $request, IncidentReport $incidentReport,){
        // $input = $request['incidentReport'];
        // $incidentReport -> fill($input)->save();

        // //画像添付時のみcloudinaryへ画像を送信し、画像のURLを$image_urlに代入している
        // if($files = $request->file('files')){
        //     if(!is_null($files)){
        // $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        // $incidentReportImage = $incidentReport->incidentReportImages()->create([
        //     'image_url' => $image_url,
        // ]);
        // }
        // インプットのデータをフィルし、保存
    // $input = request()->all();
    // dd($input);
    $input = $request['incidentReport'];
    $incidentReport->fill($input)->save();

    // 画像がアップロードされた場合のみ処理
    if ($files = $request->file('files')) {
        // トランザクションを開始
        DB::beginTransaction();

        try {
            // 各ファイルをCloudinaryにアップロードし、画像URLを保存
            foreach ($files as $file) {
                $image_url = Cloudinary::upload($file->getRealPath())->getSecurePath();

                // 画像をIncidentReportImageとして保存
                $incidentReport->incidentReportImages()->create([
                    'image_url' => $image_url,
                ]);
            }

            // トランザクションをコミット
            DB::commit();

            // 成功した場合のリダイレクト
            return redirect('/incident_reports/' . $incidentReport->id)->with(['message' => '報告書と画像が正常に保存されました。', 'status' => 'info']);
        } catch (\Exception $e) {
            // エラーが発生した場合、ロールバック
            DB::rollBack();

            // エラーメッセージ
            return redirect('/incident_reports/' . $incidentReport->id)->with(['message' => '画像の保存に失敗しました。再試行してください。', 'status' => 'danger']);
        }
    }
        return redirect('/incident_reports/'.$incidentReport->id);
    }

    public function delete(IncidentReport $incidentReport){
    $incidentReport->delete();
    return redirect('/my_posts');
    }

}
