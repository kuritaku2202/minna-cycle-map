<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <title>Document</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            場所選択画面
        </x-slot>
        <body>
            <!-- メイン地図エリア -->
            <main class="map-container">
                <div id="map" style="height:650px"></div>
            </main>
            <style>
                /* 全体レイアウト */
                .container {
                    display: flex;
                    height: 100vh;
                    overflow: hidden; /* スクロールを防ぐ */
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
                </style>
        <!-- <script>
            function initMap() {
                map = document.getElementById("map");
                
                // 東京タワーの緯度、経度を変数に入れる
                let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
                
                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 13,
                    
                    // センターを東京タワーに指定
                    center: tokyoTower,
                    };
                    
                    // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                    mapObj = new google.maps.Map(map, opt);
                    
                    marker = new google.maps.Marker({
                        // ピンを差す位置を東京タワーに設定
                        position: tokyoTower,
                        
                        // ピンを差すマップを指定
                        map: mapObj,
                        
                        // ホバーしたときに「tokyotower」と表示されるように指定
                        
                        title: 'tokyotower',
                        });
                        
                        }
                    </script> -->
                    
                    <script>
                        let map;
                        
                        function initMap() {
                            // 現在地を取得
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(
                                    (position) => {
                                        const userLocation = {
                                            lat: position.coords.latitude,
                                            lng: position.coords.longitude,
                                        };
                                        
                                        // 地図の初期設定
                                        map = new google.maps.Map(document.getElementById("map"), {
                                            center: userLocation,
                                            zoom: 14,
                                        });
                                        
                                        // 現在地にマーカーを表示
                                        new google.maps.Marker({
                                            position: userLocation,
                                            map: map,
                                            title: "現在地",
                                        });
                                        
                                        // PlacesServiceを利用して駐輪場を検索
                                        const service = new google.maps.places.PlacesService(map);
                                        const request = {
                                            location: userLocation,
                                            radius: 5000, // 半径5km
                                            type: "bicycle_store", // 駐輪場に関連する施設（例: 自転車ショップ）
                                        };
                                        
                                        service.nearbySearch(request, (results, status) => {
                                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                                for (let i = 0; i < results.length; i++) {
                                                    createMarker(results[i]);
                                                }
                                            } else {
                                                alert("駐輪場が見つかりませんでした。");
                                            }
                                        });
                                    },
                                    () => {
                                        alert("位置情報の取得に失敗しました。");
                                    }
                                );
                            } else {
                                alert("ブラウザが位置情報サービスをサポートしていません。");
                            }
                        }
                        
                        function createMarker(place) {
                            const marker = new google.maps.Marker({
                                map: map,
                                position: place.geometry.location,
                                title: place.name,
                            });
                            
                            // マーカーをクリックしたときに詳細を表示
                            marker.addListener("click", () => {
                                const lat = place.geometry.location.lat();
                                const lng = place.geometry.location.lng();
                                alert(`施設名: ${place.name}\n緯度: ${lat}\n経度: ${lng}`);
                            });
                        }
                        
                        // ページ読み込み時に地図を初期化
                        window.onload = initMap;
                        </script>
    <script src="{{ asset('js/home.script.js') }}" defer></script>
        <!-- Google Maps APIの読み込み（keyには自分のAPI_KEYを指定） -->
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyClfznW0DwXyNBbAm_IoZGm4CskZ5shFfY&callback=initMap" async defer></script>
        </body>
    </x-app-layout>
</html>