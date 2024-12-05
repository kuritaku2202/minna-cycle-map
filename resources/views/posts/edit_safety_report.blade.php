<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrapの導入 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <title>投稿編集</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            <!-- 任意の名前を入力 -->
            投稿編集
        </x-slot>
            <body>
                <div class="content">
                    <h1 class="name">{{ $post->spot->name }}</h1>
                    <form action="/safety_reports/{{ $post->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="date">
                            <h2>駐輪場の訪問日</h2>
                            <p class="date_error" style="color:red">{{ $errors->first('safetyReport.date') }}</p>
                            <input type="date" name="safetyReport[date]" value="{{ $post->date }}"/>
                        </div>
                        <div class="time_slot">
                            <h2>訪問した時間帯</h2>
                            @foreach ($timePeriods as $timePeriod)
                                <input type="radio" name="safetyReport[time_period_id]" value="{{ $timePeriod->id }}"
                                {{ old('safetyReport.time_period_id') == $timePeriod->id ? 'checked' : '' }}>
                                {{ $timePeriod->time_slot }}
                                </input><br>
                            @endforeach
                        </div>
                        <div class="security_stuff">
                            <h2>警備スタッフはいましたか？</h2>
                            <input type="radio" name="safetyReport[security_staff_id]" value="1"
                                {{ old('safetyReport.security_staff_id', $safetyReport->security_staff_id ?? '') == 1 ? 'checked' : '' }}>
                            わからない
                            <br>
                            <input type="radio" name="safetyReport[security_staff_id]" value="2"
                                {{ old('safetyReport.security_staff_id', $safetyReport->security_staff_id ?? '') == 2 ? 'checked' : '' }}>
                            はい
                            <br>
                            <input type="radio" name="safetyReport[security_staff_id]" value="3"
                                {{ old('safetyReport.security_staff_id', $safetyReport->security_staff_id ?? '') == 3 ? 'checked' : '' }}>
                            いいえ
                            <br>
                        </div>
                        <div class="security_camera">
                            <h2>防犯カメラはありましたか？</h2>
                            <input type="radio" name="safetyReport[security_camera_id]" value="1" 
                                {{ old('safetyReport.security_camera_id', $safetyReport->security_camera_id ?? '') == 1 ? 'checked' : '' }} />
                            わからない
                            <br>
                            <input type="radio" name="safetyReport[security_camera_id]" value="2" 
                                {{ old('safetyReport.security_camera_id', $safetyReport->security_camera_id ?? '') == 2 ? 'checked' : '' }} />
                            はい
                            <br>
                            <input type="radio" name="safetyReport[security_camera_id]" value="3" 
                                {{ old('safetyReport.security_camera_id', $safetyReport->security_camera_id ?? '') == 3 ? 'checked' : '' }} />
                            いいえ
                            <br>
                        </div>
                        <div class="description">
                            <h2>その他の情報</h2>
                            <input type="text" name="safetyReport[description]"  value="{{ $post->description}}"></input>
                        </div>
                        <input type="submit" value="保存する"/>
                        <a href="/safety_reports/{{ $post->id }}">戻る</a>
                    </form>
            </body>
    </x-app-layout>
</html>