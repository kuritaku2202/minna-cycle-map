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
            <!-- ヘッダー名を入力 -->
            {{ Auth::user()->name }}の投稿一覧
        </x-slot>
            <body>
            <!-- 被害報告 -->
                <div class="mt-1 alert alert-primary" role="alert">
                    <h1>被害報告</h1>
                </div>
                <div class="container text-center">
                    <div class="row row-cols-4">
                        @foreach ($myIncidentReports as $post )
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h2 class="card-title">[被害に遭った日]:{{ $post->date }}</h2>
                                        <h3 class="card-text">[時間帯]:{{ $post->timePeriod->time_slot}}</h3>
                                        <h3>[詳細]</h3>
                                        <p class="card-text">{{ $post->description}}</p>
                                        <a href="/incident_reports/{{ $post->id }}" class="btn btn-primary">詳細・編集</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            <!-- 不審者・不審物情報 -->
                <div class="mt-5 alert alert-primary" role="alert">
                    <h1>不審者・不審物情報</h1>
                </div>
                <div class="container text-center">
                    <div class="row row-cols-4">
                        @foreach ($mySuspiciousReports as $post )
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h2 class="card-title">[被害に遭った日]:{{ $post->date }}</h2>
                                        <h3 class="card-text">[時間帯]:{{ $post->timePeriod->time_slot}}</h3>
                                        <h3>[詳細]</h3>
                                        <p class="card-text">{{ $post->description}}</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            <!-- 駐輪場の安全情報の共有 -->
                <div class="mt-5 alert alert-primary" role="alert">
                    <h1>駐輪場の安全情報の共有</h1>
                </div>
                <div class="container text-center">
                    <div class="row row-cols-4">
                        @foreach ($mySafetyReports as $post )
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h2 class="card-title">[被害に遭った日]:{{ $post->date }}</h2>
                                        <h3 class="card-text">[時間帯]:{{ $post->timePeriod->time_slot}}</h3>
                                        <h3 class="card-text">[監視員]{{ $post->securityStaff->status }}</h3>
                                        <h3 class="card-text">[防犯カメラ]{{ $post->securityCamera->status }}</h3>
                                        <h3>[詳細]</h3>
                                        <p class="card-text">{{ $post->description}}</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </body>
    </x-app-layout>
</html>