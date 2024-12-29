<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot;

class SpotController extends Controller
{
    public function getPostsBySpot(Request $request)
    {
        $spotName = $request->query('name');
        $spot = Spot::where('name', $spotName)->first();

        if (!$spot) {
            return response()->json(['message' => 'Spot not found'], 404);
        }

        // 関連する投稿を取得
        $incidentReports = $spot->incidentReports()->with('timePeriod')->get();
        $suspiciousReports = $spot->suspiciousReports()->with('timePeriod')->get();
        $safetyReports = $spot->safetyReports()->with('timePeriod')->get();

        return response()->json([
            'spot' => $spot,
            'incident_reports' => $incidentReports,
            'suspicious_reports' => $suspiciousReports,
            'safety_reports' => $safetyReports,
        ]);
    }
}
