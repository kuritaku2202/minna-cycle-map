<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>みんなの投稿</title>
</head>
<body>
    <div class="incidentReports">
        <h1>被害報告</h1>
            @foreach ($incidentReports as $report)
            <div class="incidentReport">
            <h2 class="date">[日付：{{ $report->date }} 時間帯：{{ $report->timePeriod->time_slot}}]</h2>
                <h3>詳細</h3>
                <p>{{ $report->description }}</p>
            </div>
            @endforeach
    </div>
    <div class="suspiciousReports">
        <h1>不審者・不審物情報</h1>
            @foreach ($suspiciousReports as $report)
            <div class="suspiciousReport">
            <h2 class="date">[日付：{{ $report->date }} 時間帯：{{ $report->timePeriod->time_slot}}]</h2>
                <h3>詳細</h3>
                <p>{{ $report->description }}</p>
            </div>
            @endforeach
    </div>
    <div class="safetyReports">
        <h1>安全な駐輪場の共有</h1>
            @foreach ($safetyReports as $report)
            <div class="safetyReport">
            <h2 class="date">[日付：{{ $report->date }} 時間帯：{{ $report->timePeriod->time_slot}}]</h2>
                <h3>詳細</h3>
                <p>{{ $report->description }}</p>
            </div>
            @endforeach
    </div>
</body>
</html>