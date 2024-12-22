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
        .left-sidebar {
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
        .right-sidebar {
            width: 300px;
            height: 100vh;
            z-index: 9999;
            position: fixed;
            right: 0;
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
    <!-- <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$google_map_api_key}}&libraries=places&callback=initMap" async defer></script> -->
    
    <script>
    (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
        key: "{{$google_map_api_key}}",
        v: "weekly",
        // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
        // Add other bootstrap parameters as needed, using camel case.
    });
    </script>

</head>
<x-app-layout>
    <body>
        <div class="left-sidebar">
            <h2>最近の投稿</h2>
            <ul id="post-list" class="post-list">
                <!-- 投稿一覧はここに表示される -->
            </ul>
        </div>

        <div class="right-sidebar">
            <h2>駐輪場情報</h2>
            <div id="parking-details" class="parking-details">
                <!-- 詳細情報がここに表示される -->
            </div>
        </div>

        <div class="map-container" id="map"></div>
        <script>
            let map;
            const markers = [];

            async function initMap() {
                // //マップの初期状態を設定
                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            var lat = position.coords.latitude;
                            var lng = position.coords.longitude;
                            map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat, lng },
                                zoom: 16,
                                mapId: "DEMO_MAP_ID",
                            });
                            console.log('初期化されました',map);

                            const pinImg = document.createElement("img");
                            pinImg.src = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                            marker = new google.maps.marker.AdvancedMarkerElement({
                                map: map,
                                position: mapLatLng,
                                title: "現在地",
                                content: pinImg,
                            });

                            findPlaces(lat, lng);

                            // searchNearbyParking(lat, lng, map)
                            map.addListener("click", (e) => {
                                console.log(e);
                                const clickedLat = e.latLng.lat();
                                const clickedLng = e.latLng.lng();
                                console.log(clickedLat,clickedLng);
                                handleMapClick(clickedLat, clickedLng, map);
                            });
                        },
                        function(error){
                            console.log('現在地取得失敗');
                            alert("現在地の取得に失敗しました。デフォルト位置を使用します。");
                            var lat = 35.729493379635535;
                            var lng = 139.71086479574538;

                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat, lng },
                                zoom: 16,
                            });
                            findPlaces(lat, lng);
                        }
                    );
                } else {
                    console.log('現在地サポートなし');
                    alert("現在地の取得がサポートされていません。デフォルト位置を使用します。");
                    var lat = 35.729493379635535;
                    var lng = 139.71086479574538;
                    const map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat, lng },
                        zoom: 16,
                    });
                    findPlaces(lat, lng);
                }
            }

            // サイドバーを更新する関数
            function updateSidebar(place) {
                const parkingDetailsElement = document.getElementById("parking-details");
                parkingDetailsElement.innerHTML = ""; // サイドバーの内容をクリア

                // 名前と住所を表示
                const nameElement = document.createElement("h3");
                nameElement.textContent = place.displayName;

                const addressElement = document.createElement("p");
                addressElement.textContent = place.formattedAddress || "住所情報がありません";

                parkingDetailsElement.appendChild(nameElement);
                parkingDetailsElement.appendChild(addressElement);
            }

            async function findPlaces(lat, lng) {

                const { Place } = await google.maps.importLibrary("places");
                //@ts-ignore
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
                const request = {
                    textQuery: "駐輪場",    //keywordに近いところ
                    fields: ["displayName", "location", "businessStatus"],  //ほしい情報
                    locationBias: { center: { lat, lng }, radius: 5000 }, // 検索範囲をクリック位置に設定
                    includedType: "",                                    //検索対象のタイプを指定
                    isOpenNow: true,                                        //営業中のものだけにする(true)かしない(false)か
                    language: "ja",                                         //日本語ならja
                    maxResultCount: 20,                                      //最大20
                    minRating: 0,                                         //表示する建物の、最低評価の閾値を設定
                    region: "jp",                                           //検索の対象地域。日本ならjp
                    useStrictTypeFiltering: false,                          //includeTypeに完全一致するものだけにする(true)かしない(false)か
                };
                //@ts-ignore
                const { places } = await Place.searchByText(request);
                if (places.length) {
                
                    const { LatLngBounds } = await google.maps.importLibrary("core");
                    const bounds = new LatLngBounds();
                    console.log('places',places);
                    console.log('map',map);
                    // Loop through and get all the results.
                    places.forEach((place) => {
                        // console.log('place.location',place.location);
                        // const position = new google.maps.LatLng(place.location.lat(), place.location.lng());
                        const position = { lat: place.location.lat(), lng: place.location.lng() };
                        // console.log('position',position);
                        const markerView = new AdvancedMarkerElement({
                            map: map,
                            position: position,
                            title: place.displayName,
                        });

                        // マーカークリック時のイベント
                        marker.addListener("click", () => {
                            // updateSidebar(place);
                            // console.log(place.displayName);
                            this.updateSidebar(place);
                        });

                        markers.push(marker); // マーカーを全体リストに追加
                        bounds.extend(position);
                        bounds.extend(position);
                    });
                } else {
                    console.log("No results");
                }
            }


            // マップがクリックされたときの関数
            function handleMapClick(clickedLat, clickedLng, map) {
                // const center = new google.maps.LatLng(clickedLat, clickedLng);
                const center = { lat: clickedLat, lng: clickedLng };
                map.setCenter(center);
                findPlaces(clickedLat, clickedLng);
            }

            initMap();
        </script>
    </body>
</x-app-layout>
</html>