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
                <h1 class="name">{{$post->spot->name }}</h1>
                <h2 class="date">[被害にあった日]:{{ $post->date }}</h2>
                <h2 class="time_slot">[時間帯]:{{ $post->timePeriod->time_slot}}</h2>
                <p class="description">[詳細]:{{ $post->description}}</p>
                @if($post->incidentReportImages->isNotEmpty())
                    <h2>写真</h2>
                        @foreach($post->incidentReportImages as $image)
                            <div>
                                <img src="{{ $image->image_url }}" alt="Incident Report Image" style="max-width: 50%; height: auto;">
                                <a href="{{ $image->image_url }}" target="_blank">写真を拡大</a>
                            </div>
                        @endforeach
                @endif
                <a href="/incident_reports/{{ $post->id }}/edit">編集</a>
                <a href="/my_posts">戻る</a>
                <form action="/incident_reports/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
                </form>

                <script>
                    function deletePost(id) {
                        'use strict'

                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
                    }
                </script>

            </body>
    </x-app-layout>
</html>