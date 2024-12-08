<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安全情報マップ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .map-container {
            width: 100%;
            height: 90%;
            margin-top: auto;
            position: absolute;
        }
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
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$google_map_api_key}}&libraries=places&callback=initMap" async defer></script>
</head>
<x-app-layout>
    <body>
        <div class="sidebar">
            <h2>最近の投稿</h2>
            <ul id="post-list" class="post-list">
                <!-- 投稿一覧はここに表示される -->
            </ul>
        </div>

        <div class="map-container" id="map"></div>
        <script>
            const MapManager = {
                map: null,
                currentLocationMarker: null,
                parkingMarkers: [],
                placesService: null,

                initMap(lat, lng) {
                    this.map = new google.maps.Map(document.getElementById('map'), {
                        center: { lat, lng },
                        zoom: 16,
                    });

                    this.placesService = new google.maps.places.PlacesService(this.map);

                    this.setCurrentLocationMarker(lat, lng);

                    this.map.addListener('click', (e) => {
                        const clickedLat = e.latLng.lat();
                        const clickedLng = e.latLng.lng();
                        this.handleMapClick(clickedLat, clickedLng);
                    });

                    this.searchNearbyParking(lat, lng);
                },

                setCurrentLocationMarker(lat, lng) {
                    if (this.currentLocationMarker) {
                        this.currentLocationMarker.setMap(null);
                    }
                    this.currentLocationMarker = new google.maps.Marker({
                        map: this.map,
                        position: { lat, lng },
                        icon: {
                            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        },
                        title: "現在地",
                    });
                },

                handleMapClick(lat, lng) {
                    this.map.panTo({ lat, lng });
                    this.searchNearbyParking(lat, lng);
                },

                searchNearbyParking(lat, lng) {
                    const request = {
                        location: new google.maps.LatLng(lat, lng),
                        radius: 1500,
                        keyword: "駐輪場",
                    };

                    this.clearParkingMarkers();

                    this.placesService.nearbySearch(request, (results, status) => {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            results.forEach((place) => this.addParkingMarker(place));
                        } else {
                            console.warn("駐輪場の検索に失敗しました:", status);
                        }
                    });
                },

                addParkingMarker(place) {
                    const marker = new google.maps.Marker({
                        map: this.map,
                        position: place.geometry.location,
                        title: place.name,
                    });
                    // マーカーがクリックされたときに地図をその位置に移動
                    marker.addListener('click', () => {
                        this.map.panTo(marker.getPosition());
                    });

                    this.parkingMarkers.push(marker);
                },

                clearParkingMarkers() {
                    this.parkingMarkers.forEach((marker) => marker.setMap(null));
                    this.parkingMarkers = [];
                },
            };

            function initMap() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        ({ coords }) => MapManager.initMap(coords.latitude, coords.longitude),
                        () => {
                            alert("現在地の取得に失敗しました。デフォルト位置を使用します。");
                            MapManager.initMap(35.729493379635535, 139.71086479574538);
                        }
                    );
                } else {
                    alert("現在地の取得がサポートされていません。デフォルト位置を使用します。");
                    MapManager.initMap(35.729493379635535, 139.71086479574538);
                }
            }
        </script>
    </body>
</x-app-layout>
</html>