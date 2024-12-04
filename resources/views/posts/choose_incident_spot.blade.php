<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Google Maps Point Marker</title>
    <x-app-layout>
        <style type="text/css">
            #map {
            height: 600px;
            width: 80%;
            }
        </style>

        <!-- Google Maps API -->
        <!-- <script>
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "{{ $api_key }}",
            v: "weekly",
            });
        </script> -->
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyClfznW0DwXyNBbAm_IoZGm4CskZ5shFfY&callback=initMap" async defer></script>
        <script>
            var marker = null;
            var lat = 35.729493379635535;
            var lng = 139.71086479574538;

            function init() {
            //初期化
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18, center: {lat: lat, lng: lng}
            });

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            //初期マーカー
            marker = new google.maps.Marker({
                map: map, position: new google.maps.LatLng(lat, lng),
            });

            //クリックイベント
            map.addListener('click', function(e) {
                clickMap(e.latLng, map);
            });

            // 初期値をフォームに設定
            updateFormFields(lat, lng);

            }

            function clickMap(geo, map) {
                lat = geo.lat();
                lng = geo.lng();

                //小数点以下6桁に丸める場合
                //lat = Math.floor(lat * 1000000) / 1000000);
                //lng = Math.floor(lng * 1000000) / 1000000);

                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;

                //中心にスクロール
                map.panTo(geo);

                //マーカーの更新
                marker.setMap(null);
                marker = null;
                marker = new google.maps.Marker({
                    map: map, position: geo
            });
                // フォームの緯度・経度を更新
                updateFormFields(lat, lng);
            }

            function updateFormFields(latitude, longitude) {
                // console.log('set_value');
                document.getElementById('hiddenLat').value = latitude;
                document.getElementById('hiddenLng').value = longitude;
            }

        </script>

        <body onload="javascript:init();">

            <p>投稿する場所を選んでください</p>
            <div id="map" style="margin-top: 10px; margin-bottom:15px;"></div>
            緯度：<input type="text" id="lat" name="lat" value="" size="20"> 経度：<input type="text" id="lng" name="lng" value="" size="20">
            <form action="/create_incident_report" method="get">
                <input type="hidden" id="hiddenLat" name="spot[latitude]">
                <input type="hidden" id="hiddenLng" name="spot[longitude]">
                <button type="submit">投稿ページへ</button>
            </form>
        </body>
    </x-app-layout>
</html>