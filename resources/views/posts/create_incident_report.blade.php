<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>投稿作成（被害報告）</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成（被害報告）
        </x-slot>
        <body>
            <form action="/create_incident_report" method="post">
                @csrf
                <div class="user">
                    <input type="hidden" name="incidentReport[user_id]" value="{{ Auth::user()->id }}">
                </div>
                <div class="date">
                    <h2>被害を受けた日付</h2>
                    <input type="date" name="incidentReport[date]"/>
                </div>
                <div class="time_slot">
                    <h2>被害を受けた時間帯</h2>
                    @foreach ($timePeriods as $timePeriod)
                        <input type="radio" name="incidentReport[time_period_id]" value="{{ $timePeriod->id }}">
                            {{ $timePeriod->time_slot}}
                        </input><br>
                    @endforeach
                </div>
                <div class="description">
                    <h2>被害の詳細</h2>
                    <textarea name="incidentReport[description]"  placeholder="被害の詳細を入力してください"></textarea>
                </div>
                <input type="submit" value="投稿する"/>
            </form>
            <div class="backButton">
                <a href="/choose_post_type">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>