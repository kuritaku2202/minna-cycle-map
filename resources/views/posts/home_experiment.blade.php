<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>安全情報マップ</title>

    <!-- スタイルシート -->
    <link rel="stylesheet" href="{{ asset('css/home.style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- BootstrapのJavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
</head>
<body>
    <x-app-layout>
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
                <div id="map" class="map"></div>
            </main>

            <!-- 右サイドバー -->
            <aside class="details-sidebar" id="details-sidebar">
                <h2>スポット詳細</h2>
                <p id="details-content">スポットをクリックすると詳細が表示されます。</p>
                <button class="close-button" id="close-details">×</button>
            </aside>
        </div>

        <!-- スタイル -->
        <style>
            /* 全体レイアウト */
            .container {
                display: flex;
                width: 100vw; /* ビューポートの幅に合わせる */
                height: 100vh;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            /* 左サイドバー */
            .sidebar {
                width: 300px;
                background-color: #f8f9fa;
                padding: 15px;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                position: sticky;
                top: 0;
                z-index: 1000;
                height: 100vh;
                overflow-y: auto;
            }

            /* メイン地図エリア */
            .map-container {
                flex-grow: 1;
                position: relative;
                height: 100vh;
                width: 100vh;
            }

            .map {
                width: 100%;
                height: 100%;
            }

            /* 右サイドバー */
            .details-sidebar {
                width: 300px;
                background-color: #fff;
                box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                position: fixed;
                top: 0;
                right: 0px; /* 右端にぴったり固定 */
                bottom: 0;
                padding: 15px;
                z-index: 1000;
                transition: right 0.3s ease;
            }

            .details-sidebar.active {
                right: 0;
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

            /* モバイル対応 */
            @media (max-width: 768px) {
                .container {
                    flex-direction: column;
                }

                .sidebar, .details-sidebar {
                    width: 100%;
                    position: relative;
                }

                .details-sidebar.active {
                    right: 0;
                    bottom: auto;
                }
            }
        </style>

        <!-- JavaScript -->
        <script>
            let map;
            let service;

            function initMap() {
                const initialLocation = { lat: 35.729493, lng: 139.710865 };

                map = new google.maps.Map(document.getElementById('map'), {
                    center: initialLocation,
                    zoom: 15,
                    disableDefaultUI: true,
                    zoomControl: true,
                });

                const request = {
                    location: initialLocation,
                    radius: 1000,
                    keyword: '駐輪場',
                };

                service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, handleSearchResults);
            }

            function handleSearchResults(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    results.forEach(place => {
                        new google.maps.Marker({
                            map,
                            position: place.geometry.location,
                            title: place.name,
                        });
                    });
                } else {
                    console.error(`検索失敗: ${status}`);
                }
            }
        </script>

        <!-- Google Maps APIの読み込み -->
        <script src="https://maps.googleapis.com/maps/api/js?key={{$google_map_api_key}}&libraries=places&callback=initMap" async defer></script>
    </x-app-layout>
</body>
</html>