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
        <div class="sidebar">
            <h2>最近の投稿</h2>
            <ul id="post-list" class="post-list">
                <!-- 投稿一覧はここに表示される -->
            </ul>
        </div>

        <div class="map-container" id="map"></div>
        <script>
            var lat = 35.729493379635535;
            var lng = 139.71086479574538;

            async function initMap() {
                // //マップの初期状態を設定
                // const { Map } = await google.maps.importLibrary("maps");
                // const map = new google.maps.Map(document.getElementById("map"), {
                //     center: { lat, lng },
                //     zoom: 16,
                // });
                // console.log(map);
                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                            var lat = position.coords.latitude;
                            var lng = position.coords.longitude;
                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat, lng },
                                zoom: 16,
                                mapId: "DEMO_MAP_ID",
                            });
                            const pinImg = document.createElement("img");
                            pinImg.src = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"


                            marker = new google.maps.marker.AdvancedMarkerElement({
                                map: map,
                                position: mapLatLng,
                                title: "現在地",
                                content: pinImg,
                            });
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

                            const map = new google.maps.Map(document.getElementById("map"), {
                                center: { lat, lng },
                                zoom: 16,
                            });

                        }
                    );
                } else {
                    console.log('現在地サポートなし');
                    alert("現在地の取得がサポートされていません。デフォルト位置を使用します。");

                    const map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat, lng },
                        zoom: 16,
                    });

                }

                // //マップの情報を取得
                // const { PlacesService } = await google.maps.importLibrary("places");
                // const placesService = new google.maps.PlacesService(map);

                // // 近くの駐輪場を表示
                // searchNearbyParking(lat, lng, map)
                // console.log(map);
                // // マップをクリックしたときの関数を定義
                // map.addListener("click", (e) => {
                //     const clickedLat = e.latLng.lat();
                //     const clickedLng = e.latLng.lng();
                //     handleMapClick(clickedLat, clickedLng);
                // });
            }

            // 近くの駐輪場を探す
            // async function searchNearbyParking(lat, lng, map) {
                
            //     console.log(lat,lng);
            //     const { PlaceService, SearchNearbyRankPreference } = await google.maps.importLibrary("places");
            //     const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
            //     let center = new google.maps.LatLng(lat, lng);
            //     const request = {
            //         fields: ["displayName", "location", "businessStatus"],
            //         locationRestriction: {
            //             center: center,
            //             radius: 1500,
            //         },
            //         // includedPrimaryTypes: ["bicycle_parking"],
            //         keyword:'駐輪場'
            //     };
            //     const { places } = await PlaceService.nearbySearch(request);

            //     if(places.length) {
            //         const { LatLngBounds } = await google.maps.importLibrary("core");
            //         const bounds = new LatLngBounds();

            //         places.forEach((place) => {
            //             const markerView = new AdvancedMarkerElement({
            //                 map,
            //                 position: place.location,
            //                 title: place.displayName,
            //             });

            //             bounds.extend(place.location);
            //         });
            //         map.fitBounds(bounds);
            //     } else {
            //         console.warn("駐輪場の検索に失敗しました:", status);
            //     }
            // }

            async function findPlaces() {
                const { Place } = await google.maps.importLibrary("places");
                //@ts-ignore
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
                const request = {
                    textQuery: "Tacos in Mountain View",      //keywordに近いところ
                    fields: ["displayName", "location", "businessStatus"],  //ほしい情報
                    includedType: "restaurant",                             //検索対象のタイプを指定
                    isOpenNow: true,                                        //営業中のものだけにする(true)かしない(false)か
                    language: "ja",                                         //日本語ならja
                    maxResultCount: 7,                                      //最大20
                    minRating: 3.2,                                         //表示する建物の、最低評価の閾値を設定
                    region: "us",                                           //検索の対象地域。日本ならjp
                    useStrictTypeFiltering: false,                          //includeTypeに完全一致するものだけにする(true)かしない(false)か
                };
                //@ts-ignore
                const { places } = await Place.searchByText(request);
                
                if (places.length) {
                    console.log(places);
                
                    const { LatLngBounds } = await google.maps.importLibrary("core");
                    const bounds = new LatLngBounds();
                    
                    console.log(map);
                    // Loop through and get all the results.
                    places.forEach((place) => {
                    const markerView = new AdvancedMarkerElement({
                        map,
                        position: place.location,
                        title: place.displayName,
                    });
                
                    bounds.extend(place.location);
                    console.log(place);
                    });
                    map.setCenter(bounds.getCenter());
                } else {
                    console.log("No results");
                }
                }


            // マップがクリックされたときの関数
            function handleMapClick(clickedLat, clickedLng, map) {
                console.log(clickedLat, clickedLng);
                let center = new google.maps.LatLng(clickedLat, clickedLng);
                map.panTo(center);
                // searchNearbyParking(clickedLat, clickedLng, map);
                findPlaces();
            }

            initMap();
        </script>
    </body>
</x-app-layout>
</html>