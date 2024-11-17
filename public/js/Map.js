

let data;
let dataEF;

document.addEventListener('DOMContentLoaded', function() {
    axios.get('/api/Map')
        .then(res=>{
            data=res.data;
            console.log(data);
            axios.get('/api/MapEF')
                .then(res1=>{
                    dataEF=res1.data;
                    OSM(data,dataEF);
                })
                .catch(err1=>{
                    console.log('發生錯誤1',err1);
                    //OSM(data);
                })
        })
        .catch(err=>{
            console.log("發生錯誤",err);
        })
});

let map = L.map('map', {
    center: [25.04083, 121.50901],
    zoom: 11,
    minZoom: 8
});

// 初始圖層
let darkLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd'
}).addTo(map);

let osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

// 新增控制器
let baseMaps = {
    "明亮模式": osmLayer,
    "暗黑模式": darkLayer
};

L.control.layers(baseMaps).addTo(map);

let southWest = L.latLng(21.5249, 119.5342), 
    northEast = L.latLng(25.3926, 122.0087), 
    bounds = L.latLngBounds(southWest, northEast);

map.setMaxBounds(bounds);
map.on('drag', function () {
    map.panInsideBounds(bounds, { animate: false });
});



let markers = new L.MarkerClusterGroup(); // 不要直接 addTo(map)，先不加到地圖上

// 清空地圖上的所有圖層
map.eachLayer(function (layer) {
    map.removeLayer(layer);
});

// 重新添加初始圖層
osmLayer.addTo(map);

// 將 MarkerClusterGroup 添加到地圖上
map.addLayer(markers);

function OSM(data, dataEF) {
    for (let property of data) {
        let popupContent;
        let found = false;

        if (Array.isArray(dataEF) && dataEF.length > 0) {
            for (let item of dataEF) {
                if (item.id === property.Id && property.Type === '環保') {
                    found = true;
                    popupContent = `
                        <div class="details">
                            <div class="address">${property.Name}</div>
                            <div class="features">
                                <div>
                                    <i aria-hidden="true" class="fa-solid fa-location-dot" title="site"></i>
                                    <span class="fa-sr-only">site</span>
                                    <span>${property.Site}</span>
                                </div>
                                <p><canvas id="canvas-${property.Id}" width="300" height="150"></canvas></p>
                            </div>
                        </div>
                    `;
                    break;
                }
            }
        }

        if (!found) {
            popupContent = `
                <div class="details">
                    <div class="address">${property.Name}</div>
                    <div class="features">
                        <div>
                            <i aria-hidden="true" class="fa-solid fa-location-dot" title="site"></i>
                            <span class="fa-sr-only">site</span>
                            <span>${property.Site}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        let customIcon = L.divIcon({
            className: 'property',
            html: `
                <div class="icon">
                    <i aria-hidden="true" class="${property.Class}" title="${property.Class}"></i>
                    <span class="fa-sr-only">${property.Class}</span>
                </div>
            `,
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });

        let marker = L.marker([property.Lat, property.Lng], { icon: customIcon });
        marker.bindPopup(popupContent);

        marker.on('mouseover', function () {
            this.bindPopup(popupContent).openPopup();

            if (found) {
                let canvasId = `canvas-${property.Id}`;
                let canvas = document.getElementById(canvasId);
                if (canvas) {
                    if (canvas.chart) {
                        canvas.chart.destroy();
                    }

                    const relevantItem = dataEF.find(item => item.id === property.Id);
                    const labels = [
                        'gen_recyclable_weight',
                        'rec_recyclable_weight',
                        'gen_food_waste_weight',
                        'rec_food_waste_weight',
                        'gen_general_waste_weight',
                        'rec_general_waste_weight',
                        'gen_hazardous_weight',
                        'rec_hazardous_weight'
                    ];

                    const genData = labels.map(label => relevantItem[label] || 0);
                    const recData = labels.map(label => relevantItem[label.replace('gen_', 'rec_')] || 0);

                    const chartData = {
                        labels: labels.map(label => label.replace(/_/g, ' ').replace('gen ', '總數 ').replace('rec ', '已回收 ')),
                        datasets: [{
                            label: '總數',
                            data: genData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                        }, {
                            label: '已回收',
                            data: recData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false,
                        }]
                    };

                    canvas.chart = new Chart(canvas, {
                        type: 'line',
                        data: chartData,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    display: false // 隱藏圖例
                                },
                                title: {
                                    display: false // 隱藏標題
                                },
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: false,
                                    },
                                    ticks: {
                                        display: false // 隱藏 X 軸刻度標籤
                                    }
                                },
                                y: {
                                    title: {
                                        display: false,
                                    },
                                    ticks: {
                                        display: false // 隱藏 Y 軸刻度標籤
                                    },
                                    beginAtZero: true
                                }
                            }
                        },
                    });
                    
                } else {
                    console.error('Canvas not found for item id:', property.Id);
                }
            }
        });

        

        markers.addLayer(marker);
    }
}



function fliter(){
    const existingDiv = document.querySelector('.fliter-content');
    const fliterBTN=document.querySelector('.fliter');

    if(existingDiv){
        existingDiv.remove();
        fliterBTN.textContent='篩';
    }else{
        fliterBTN.textContent='X';
        let div=document.createElement('div');
        div.className="fliter-content";
        div.innerHTML=`
            <label>種類</label>
                <select name="Type" id="Type">
                    <option value="">種類</option>
                    <option value="環保">環保</option>
                    <option value="文教">文教</option>
                    <option value="讀書會與講座">讀書會與講座</option>
                    <option value="社區慈善">社區慈善</option>
                    <option value="節慶活動">節慶活動</option>
                </select>
            <p></p>
            <label>地區</label>
            <input type="text" id="area" placeholder="請輸入縣市名稱">
            <p></p>
            <button onclick="fliterSite()">確認</button>
        `;
        document.body.append(div);
        
    }
    
}

function fliterSite(){
    markers.clearLayers();
    let Type=document.getElementById('Type').value;
    let Area=document.getElementById('area').value;
    fliterdata=data.filter(item=>item.Type.includes(Type) && item.Site.includes(Area));
    OSM(fliterdata,dataEF);
}