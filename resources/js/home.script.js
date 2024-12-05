let map;
let markers = [];
const posts = [
    { id: 1, type: 'theft', title: '盗難事件A', content: 'ここで盗難が発生しました', position: { lat: 35.6895, lng: 139.6917 } },
    { id: 2, type: 'suspicious', title: '不審者目撃B', content: '不審者が目撃されました', position: { lat: 35.6890, lng: 139.6920 } },
    { id: 3, type: 'safe', title: '安全駐輪場C', content: '安全な駐輪場です', position: { lat: 35.6892, lng: 139.6900 } },
];

// // 初期化
// function initMap() {
//     map = new google.maps.Map(document.getElementById('map'), {
//         center: { lat: 35.6895, lng: 139.6917 },
//         zoom: 14,
//         mapTypeControl: false,
//         streetViewControl: false,
//     });

//     addMarkers();
// }
<div class="map-container" id="map"></div>

    let service;
    let userMarker;

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
                            url: 'https://higemura.com/wordpress/wp-content/uploads/2018/10/ic_gmap_mylocation.svg',
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
    }

    function searchNearby(location) {
        // Places APIで駐輪場を検索
        const request = {
            location: location,
            radius: 5000, // 半径5キロ（メートル単位）
            keyword: '駐輪場'
        };

        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, (results, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                results.forEach((place) => {
                    // 駐輪場の位置にピンを刺す
                    new google.maps.Marker({
                        position: place.geometry.location,
                        map: map,
                        title: place.name,
                    });

                    console.log(`駐輪場名: ${place.name}, 位置: ${place.geometry.location}`);
                });
            } else {
                console.error("駐輪場の検索に失敗しました: ", status);
            }
        });
    }

// マーカーを追加
function addMarkers() {
    clearMarkers();
    posts.forEach(post => {
        const marker = new google.maps.Marker({
            position: post.position,
            map: map,
            title: post.title,
            icon: getIcon(post.type),
        });

        marker.addListener('click', () => {
            showDetails(post);
        });

        markers.push({ marker, type: post.type });
    });
}

// アイコンをタイプごとに設定
function getIcon(type) {
    switch (type) {
        case 'theft':
            return 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
        case 'suspicious':
            return 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png';
        case 'safe':
            return 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
    }
}

// マーカーをクリア
function clearMarkers() {
    markers.forEach(({ marker }) => marker.setMap(null));
    markers = [];
}

// 右サイドバーで詳細を表示
function showDetails(post) {
    const detailsSidebar = document.getElementById('details-sidebar');
    const detailsContent = document.getElementById('details-content');
    detailsContent.innerText = `${post.title}\n${post.content}`;
    detailsSidebar.classList.add('active');
}

// 右サイドバーを閉じる
document.getElementById('close-details').addEventListener('click', () => {
    const detailsSidebar = document.getElementById('details-sidebar');
    detailsSidebar.classList.remove('active');
});

// 初期化
window.onload = () => {
    initMap();
};
