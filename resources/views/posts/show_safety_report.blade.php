<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrapの導入 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <title>投稿詳細</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            <!-- 任意の名前を入力 -->
            投稿詳細
        </x-slot>
            <body>
                <h1 class="date">[訪問日]:{{ $post->date }}</h1>
                <h2 class="time_slot">[時間帯]:{{ $post->timePeriod->time_slot}}</h2>
                <h2 class="security_staff">[監視員]{{ $post->securityStaff->status }}</h2>
                <h2 class="security_camera">[防犯カメラ]{{ $post->securityCamera->status}}</h2>
                <p class="description">[詳細]:{{ $post->description}}</p>
                <a href="/safety_reports/{{ $post->id }}/edit">編集</a>
                <a href="/my_posts">戻る</a>

            </body>
    </x-app-layout>
</html>