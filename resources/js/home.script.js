let map;
let markers = [];
const posts = [
    { id: 1, type: 'theft', title: '盗難事件A', content: 'ここで盗難が発生しました', position: { lat: 35.6895, lng: 139.6917 } },
    { id: 2, type: 'suspicious', title: '不審者目撃B', content: '不審者が目撃されました', position: { lat: 35.6890, lng: 139.6920 } },
    { id: 3, type: 'safe', title: '安全駐輪場C', content: '安全な駐輪場です', position: { lat: 35.6892, lng: 139.6900 } },
];

// 初期化
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 35.6895, lng: 139.6917 },
        zoom: 14,
        mapTypeControl: false,
        streetViewControl: false,
    });

    addMarkers();
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
