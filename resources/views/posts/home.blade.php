<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全情報マップ</title>
    <link rel="stylesheet" href="{{ asset('css/home.style.css') }}"></head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<x-app-layout>

    <body>
        <div class="container">
        <!-- 左サイドバー -->
            <aside class="sidebar" id="sidebar">
                <h2>カテゴリフィルター</h2>
                <div class="filters">
                    <label><input type="checkbox" id="theft" checked> 盗難情報</label><br>
                    <label><input type="checkbox" id="suspicious" checked> 不審者情報</label><br>
                    <label><input type="checkbox" id="safe" checked> 安全な駐輪場</label>
                </div>
                <h2>最近の投稿</h2>
                <ul class="recent-posts" id="recent-posts"></ul>
            </aside>

        <!-- メイン地図エリア -->
            <main class="map-container">
                <div id="map" style="height:650px"></div>
            </main>

            <!-- 右サイドバー -->
            <aside class="details-sidebar" id="details-sidebar">
                <h2>スポット詳細</h2>
                <p id="details-content">スポットをクリックすると詳細が表示されます。</p>
                <button class="close-button" id="close-details">×</button>
            </aside>
        </div>
        <style>
                        /* 全体レイアウト */
            .container {
                display: flex;
                height: 100vh;
                overflow: hidden; /* スクロールを防ぐ */
            }

            /* 左サイドバー */
            .sidebar {
                width: 300px;
                background-color: #f8f9fa;
                padding: 15px;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                position: absolute;
                left: 0;
                top: 10;
                bottom: 0;
                overflow-y: auto;
                z-index: 1000;
            }

            /* メイン地図エリア */
            .map-container {
                flex-grow: 1;
                position: relative;
            }

            #map {
                width: 100%;
                height: 100%;
            }

            /* 右サイドバー */
            .details-sidebar {
                width: 300px;
                background-color: #ffffff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                position: absolute;
                right: -300px; /* 初期状態は非表示 */
                top: 0;
                bottom: 0;
                transition: right 0.3s ease;
                padding: 15px;
                z-index: 1000;
            }

            /* 右サイドバーが表示状態 */
            .details-sidebar.active {
                right: 0; /* 表示状態 */
            }

            /* 閉じるボタン */
            .close-button {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: #ff5e5e;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 5px 10px;
                cursor: pointer;
            }

            .close-button:hover {
                background-color: #d9534f;
            }
            </style>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfznW0DwXyNBbAm_IoZGm4CskZ5shFfY&libraries=places"></script>
        <script>
            // function initMap() {
            //     map = document.getElementById("map");
                
            //     // 東京タワーの緯度、経度を変数に入れる
            //     let tokyoTower = {lat: 35.6585769, lng: 139.7454506};

            //     // オプションの設定
            //     opt = {
            //         // 地図の縮尺を指定
            //         zoom: 13,

            //         // センターを東京タワーに指定
            //         center: tokyoTower,
            //     };

            //     // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
            //     mapObj = new google.maps.Map(map, opt);

            //     marker = new google.maps.Marker({
            //         // ピンを差す位置を東京タワーに設定
            //         position: tokyoTower,

            //         // ピンを差すマップを指定
            //         map: mapObj,

            //         // ホバーしたときに「tokyotower」と表示されるように指定

            //         title: 'tokyotower',
            //     });

            // }
            let map;
        let service;

        function initMap() {
            // 初期位置の設定（任意の位置）
            const initialLocation = { lat: 35.729493, lng: 139.710865 };

            // 地図の初期化
            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 15,
            });

            // Places APIで駐輪場を検索
            const request = {
                location: initialLocation,
                radius: 1000, // メートル単位
                keyword: '駐輪場', // キーワードで検索
            };

            // Placesサービスを初期化して検索を実行
            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, handleSearchResults);
        }

        function handleSearchResults(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                results.forEach((place) => {
                    // マーカーを地図に追加
                    new google.maps.Marker({
                        map,
                        position: place.geometry.location,
                        title: place.name,
                    });

                    // コンソールで確認（デバッグ用）
                    console.log(`Name: ${place.name}, Location: ${place.geometry.location}`);
                });
            } else {
                console.error(`検索失敗: ${status}`);
            }
        }
        </script>
        <script src="{{ asset('js/home.script.js') }}" defer></script>
        <!-- Google Maps APIの読み込み（keyには自分のAPI_KEYを指定） -->
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyClfznW0DwXyNBbAm_IoZGm4CskZ5shFfY&callback=initMap" async defer></script>
    <script></script>
    </body>
</x-app-layout>
</html>