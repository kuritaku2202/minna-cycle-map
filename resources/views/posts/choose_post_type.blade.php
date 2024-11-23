<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <title>投稿タイプの選択</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            投稿作成
        </x-slot>
        <body>
            <div class="container">
                <!-- Content here -->
                <div class="alert alert-primary" role="alert">
                    投稿の種類を選んでください
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">被害報告</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/create_incident_report" class="btn btn-primary">投稿する</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">不審者・不審物の報告</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/create_suspicious_report" class="btn btn-primary">投稿する</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">安全な駐輪場情報の共有</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="/create_safety_report" class="btn btn-primary">投稿する</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <h2><a href="/create_incident_report">被害報告</a></h2>
                <h2><a href="/create_suspicious_report">不審者・不審物の報告</a></h2>
                <h2><a href="/create_safety_report">安全な駐輪場情報の共有</a></h2> -->
            </div>
        </body>
    </x-app-layout>
</html>