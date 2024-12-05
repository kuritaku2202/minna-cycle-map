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
                    <form action="/suspicious_reports/{{ $post->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="date">
                            <h2>目撃日</h2>
                            <p class="date_error" style="color:red">{{ $errors->first('suspiciousReport.date') }}</p>
                            <input type="date" name="suspiciousReport[date]" value="{{ $post->date }}"/>
                        </div>
                        <div class="time_slot">
                            <h2>目撃した時間帯</h2>
                            @foreach ($timePeriods as $timePeriod)
                                <input type="radio" name="suspiciousReport[time_period_id]" value="{{ $timePeriod->id }}"
                                {{ old('suspiciousReport.time_period_id') == $timePeriod->id ? 'checked' : '' }}>
                                {{ $timePeriod->time_slot }}
                                </input><br>
                            @endforeach
                        </div>
                        <div class="description">
                            <h2>不審者・不審物の詳細情報</h2>
                            <p class="description_error" style="color:red">{{ $errors->first('suspiciousReport.description') }}</p>
                            <input type="text" name="suspiciousReport[description]"  value="{{ $post->description}}"></input>
                        </div>
                        <input type="submit" value="保存する"/>
                        <a href="/suspicious_reports/{{ $post->id }}">戻る</a>
                    </form>
            </body>
    </x-app-layout>
</html>