<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrapの導入 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <title>Document</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            <!-- 任意の名前を入力 -->
            投稿編集
        </x-slot>
            <body>
                <div class="content">
                    <form action="/posts/{{ $post->id }}" method="post">
                        @csrf
                        @method('put')
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
                </div>
            </body>
    </x-app-layout>
</html>