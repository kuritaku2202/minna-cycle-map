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
            <div class="card">
                <h1 class="card-header postType">
                    <!-- <div class="alert alert-danger" role="alert">
                        被害報告
                    </div> -->
                被害報告
                </h1>
                <div class="card-body">
                    <h2 class="card-title name">[投稿場所]:{{$post->spot->name }}</h2>
                    <h3 class="date">[被害にあった日]:{{ $post->date }}</h3>
                    <h3 class="time_slot">[時間帯]:{{ $post->timePeriod->time_slot}}</h3>
                    <p class="description">[詳細]:{{ $post->description}}</p>
                    <div class="postImages">
                        @if($post->incidentReportImages->isNotEmpty())
                            <h2>[写真]</h2>
                            <div class="grid text-center">
                                @foreach($post->incidentReportImages as $image)
                                    <div class="g-col-6 g-col-md-4">
                                        <a href="{{ $image->image_url }}" target="_blank">
                                            <img src="{{ $image->image_url }}" class="img-thumbnail" alt="Incident Report Image" style="max-width: 20%; height: auto;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <a class="btn btn-outline-primary" href="/incident_reports/{{ $post->id }}/edit">編集</a>
                    <a class="btn btn-outline-primary" href="/my_posts">戻る</a>
                    <form action="/incident_reports/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger" type="button" onclick="deletePost({{ $post->id }})">削除</button>
                    </form>
                </div>
            </div>

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