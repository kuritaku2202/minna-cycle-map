<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>投稿作成（不審者・不審物情報）</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成（不審者・不審物情報）
        </x-slot>
        <body>
            <form action="/create_suspicious_report" method="post">
                @csrf
                <div class="user">
                    <input type="hidden" name="suspiciousReport[user_id]" value="{{ Auth::user()->id }}">
                </div>
                <div class="date">
                    <h2>目撃した日付</h2>
                    <input type="date" name="suspiciousReport[date]"/>
                </div>
                <div class="time_slot">
                    <h2>目撃した時間帯</h2>
                    @foreach ($timePeriods as $timePeriod)
                        <input type="radio" name="suspiciousReport[time_period_id]" value="{{ $timePeriod->id }}">
                            {{ $timePeriod->time_slot}}
                        </input><br>
                    @endforeach
                </div>
                <div class="description">
                    <h2>不審者・不審物の詳細情報</h2>
                    <textarea name="suspiciousReport[description]"  placeholder="不審者・不審物の詳細情報を入力してください"></textarea>
                </div>
                <input type="submit" value="投稿する"/>
            </form>
            <div class="backButton">
                <a href="/choose_post_type">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>