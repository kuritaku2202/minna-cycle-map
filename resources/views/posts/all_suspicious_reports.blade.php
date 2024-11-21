<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>不審者・不審物報告</title>
</head>
<x-app-layout>
    <x-slot name="header">
        不審者・不審物情報一覧
    </x-slot>
    <body>
        <h1>不審者・不審物報告</h1>
        <div class="suspiciousReports">
            @foreach ($suspiciousReports as $suspiciousReport)
                <div class="suspiciousReport">
                    <h2 class="date">{{ $suspiciousReport->date}}、時間帯：{{ $suspiciousReport->timePeriod->time_slot}}</h2>
                    <h3>詳細</h3>
                    <p class="body">{{$suspiciousReport->description}}</p>
                </div>
            @endforeach
        </div>
        <div class="backButton">
            <a href="/choose_post_type">戻る</a>
        </div>
    </body>
</x-app-layout>
</html>