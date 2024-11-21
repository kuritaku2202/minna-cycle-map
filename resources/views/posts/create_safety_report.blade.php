<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>投稿作成（安全情報）</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成（安全情報）
        </x-slot>
        <body>
            <form action="/create_safety_report" method="post">
                @csrf
                <div class="user">
                    <input type="hidden" name="safetyReport[user_id]" value="{{ Auth::user()->id }}">
                </div>
                <div class="date">
                    <h2>駐輪場の訪問日</h2>
                    <input type="date" name="safetyReport[date]"/>
                </div>
                <div class="time_slot">
                    <h2>訪問した時間帯</h2>
                    @foreach ($timePeriods as $timePeriod)
                        <input type="radio" name="safetyReport[time_period_id]" value="{{ $timePeriod->id }}">
                            {{ $timePeriod->time_slot}}
                        </input><br>
                    @endforeach
                </div>
                <div class="safety_stuff">
                    <h2>警備スタッフはいましたか？</h2>
                    <input type="radio" name="safetyReport[safety_stuff]" value="1">
                    はい
                    </input><br>
                    <input type="radio" name="safetyReport[safety_stuff]" value="0">
                    いいえ
                    </input><br>
                    <input type="radio" name="safetyReport[safety_stuff]" value="-1">
                    わからない
                    </input><br>
                </div>
                <div class="safety_camera">
                    <h2>防犯カメラはありましたか？</h2>
                    <input type="radio" name="safetyReport[safety_camera]" value="1">
                    はい
                    </input><br>
                    <input type="radio" name="safetyReport[safety_camera]" value="0">
                    いいえ
                    </input><br>
                    <input type="radio" name="safetyReport[safety_camera]" value="-1">
                    わからない
                    </input><br>
                </div>
                <div class="description">
                    <h2>その他の情報</h2>
                    <textarea name="safetyReport[description]"  placeholder="その他の情報を入力してください"></textarea>
                </div>
                <input type="submit" value="投稿する"/>
            </form>
            <div class="backButton">
                <a href="/choose_post_type">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>