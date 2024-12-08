<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Google Maps with Nearby Parking</title>
    <style>
        #map {
            height: 600px;
            width: 80%;
        }
        #parking-info {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$google_map_api_key}}&libraries=places&callback=initMap" async defer></script>
</head>
<x-app-layout>
<body>
    <p>投稿する場所を選んでください</p>
    <div id="map"></div>
    <div id="parking-info"></div>
    <form action="/create_safety_report" method="get">
        <input type="hidden" id="hiddenLat" name="spot[latitude]">
        <input type="hidden" id="hiddenLng" name="spot[longitude]">
        <input type="hidden" id="hiddenName" name="spot[name]">
        <button type="submit">投稿ページへ</button>
    </form>

    <script>
        // Mapとマーカーの管理オブジェクト
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

                // 現在地マーカーの表示
                this.setCurrentLocationMarker(lat, lng);

                // クリックイベント
                this.map.addListener('click', (e) => {
                    const clickedLat = e.latLng.lat();
                    const clickedLng = e.latLng.lng();
                    this.handleMapClick(clickedLat, clickedLng);
                });

                // 駐輪場検索
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
                this.updateFormFields(lat, lng);
            },

            handleMapClick(lat, lng) {
                this.map.panTo({ lat, lng });
                this.searchNearbyParking(lat, lng);
            },

            searchNearbyParking(lat, lng) {
                const request = {
                    location: new google.maps.LatLng(lat, lng),
                    radius: 1500, // 1.5km以内
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

                marker.addListener("click", () => {
                    this.showParkingDetails(place);
                });

                this.parkingMarkers.push(marker);
            },

            clearParkingMarkers() {
                this.parkingMarkers.forEach((marker) => marker.setMap(null));
                this.parkingMarkers = [];
            },

            showParkingDetails(place) {
                const { name, vicinity, rating, geometry } = place;
                const detailsHtml = `
                    <h3>${name}</h3>
                    <p>${vicinity}</p>
                    <p>評価: ${rating || "情報なし"}</p>
                `;
                document.getElementById("parking-info").innerHTML = detailsHtml;

                const clickedLat = geometry.location.lat();
                const clickedLng = geometry.location.lng();
                this.updateFormFields(clickedLat, clickedLng, name);
                this.map.panTo(geometry.location);
            },

            updateFormFields(lat, lng, name="") {
                document.getElementById("hiddenLat").value = lat;
                document.getElementById("hiddenLng").value = lng;
                if(name){
                    document.getElementById("hiddenName").value = name;
                }
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