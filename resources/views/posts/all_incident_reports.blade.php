<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>被害報告</title>
</head>
<x-app-layout>
    <x-slot name="header">
        被害報告一覧
    </x-slot>
    <body>
        <h1>被害報告</h1>
        <div class="incidentReports">
            @foreach ($incidentReports as $incidentReport)
                <div class="incidentReport">
                    <h2 class="date">{{ $incidentReport->date}}、時間帯：{{ $incidentReport->timePeriod->time_slot}}</h2>
                    <h3>詳細</h3>
                    <p class="body">{{$incidentReport->description}}</p>
                </div>
            @endforeach
        </div>
        <div class="backButton">
            <a href="/choose_post_type">戻る</a>
        </div>
    </body>
</x-app-layout>
</html>