<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全情報マップ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* 地図コンテナ */
        .map-container {
            width: 100%;
            height: 90%;
            margin-top: auto;
            position: absolute;
        }

        /* サイドバー */
        .sidebar {
            width: 300px;
            height: 100vh;
            z-index: 9999;
            position: fixed;
            left: 0;
            margin-top: auto;
            background-color: #f8f9fa;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        /* 投稿リスト */
        .post-list {
            list-style-type: none;
            padding: 0;
        }

        .post-list li {
            background-color: #ffffff;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-button {
            position: absolute;
            margin-top: auto;
            right: 10px;
            z-index: 9999;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- Google Maps APIの読み込み -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{$google_map_api_key}}&libraries=places&callback=initMap" async defer></script>
</head>
<x-app-layout>
<body>
    <!-- 左サイドバー -->
    <div class="sidebar">
        <h2>最近の投稿</h2>
        <ul id="post-list" class="post-list">
            <!-- 投稿一覧はここに表示される -->
        </ul>
    </div>

    <!-- 地図表示エリア -->
    <div class="map-container" id="map"></div>
    <button class="search-button" id="search-button">このエリアを再検索</button>

    <script>
        let map;
        let service;
        let userMarker;
        let markers = []; // 現在のマーカーを保持する配列

        // 仮の投稿データ
        const posts = [
            { id: 1, title: "投稿タイトル1", description: "詳細情報1" },
            { id: 2, title: "投稿タイトル2", description: "詳細情報2" },
            { id: 3, title: "投稿タイトル3", description: "詳細情報3" }
        ];

        // 投稿リストの表示
        function displayPosts() {
            const postListElement = document.getElementById('post-list');
            postListElement.innerHTML = ''; // 既存の投稿をクリア

            posts.forEach(post => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${post.title}</strong><br>${post.description}`;
                postListElement.appendChild(li);
            });
        }

        function initMap() {
            // 地図を初期化
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 35.0, lng: 135.0 }, // 初期位置（仮）
                zoom: 15,
            });

            // 現在地を取得
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const userLocation = {
                            lat: pos.coords.latitude,
                            lng: pos.coords.longitude
                        };

                        // 現在地にピンを刺す
                        userMarker = new google.maps.Marker({
                            position: userLocation,
                            map: map,
                            icon: {
                                url: '/Users/KuriharaTakuma/Downloads/iconDownload.cgi.png',
                                scaledSize: new google.maps.Size(32, 32)
                            },
                            title: '現在地'
                        });

                        // 地図の中心を現在地に移動
                        map.setCenter(userLocation);

                        // 半径5キロ以内の駐輪場を検索
                        searchNearby(userLocation);
                    },
                    (err) => {
                        console.error("位置情報の取得に失敗しました: ", err);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    }
                );
            } else {
                console.error("ブラウザが位置情報APIに対応していません。");
            }

            // 投稿データを表示
            displayPosts();

            // 再検索ボタンのイベントリスナー
            document.getElementById('search-button').addEventListener('click', () => {
                const center = map.getCenter(); // マップの中心を取得
                searchNearby({ lat: center.lat(), lng: center.lng() });
            });
        }

        function clearMarkers() {
            // 現在のマーカーを削除
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        function searchNearby(location) {
            const request = {
                location: location,
                keyword: '駐輪場',
                rankBy: google.maps.places.RankBy.DISTANCE, // 近い順に取得
                language:'ja',
            };

            clearMarkers(); // 既存のマーカーをクリア

            service = new google.maps.places.PlacesService(map);
            service.nearbySearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    // 結果を最大20件まで処理
                    const fragment = document.createDocumentFragment();
                    results.slice(0, 20).forEach((place) => {
                        const marker = new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            title: place.name,
                        });
                        markers.push(marker); // マーカーを配列に保存
                    });
                } else {
                    console.error(`検索失敗: ${status}`);
                }
            });
        }
    </script>
</body>
</x-app-layout>
</html>