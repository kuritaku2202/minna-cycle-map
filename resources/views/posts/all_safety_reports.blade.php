<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全に関する報告</title>
</head>
<x-app-layout>
    <x-slot name="header">
        安全報告一覧
    </x-slot>
    <body>
        <h1>安全に関する報告</h1>
        <div class="safetyReports">
            @foreach ($safetyReports as $safetyReport)
                <div class="safetyReport">
                    <h2 class="date">{{ $safetyReport->date}}、時間帯：{{ $safetyReport->timePeriod->time_slot}}</h2>
                    <h3>報告内容</h3>
                    <p class="body">{{$safetyReport->description}}</p>
                </div>
            @endforeach
        </div>
        <div class="backButton">
            <a href="/choose_post_type">戻る</a>
        </div>
    </body>
</x-app-layout>
</html>