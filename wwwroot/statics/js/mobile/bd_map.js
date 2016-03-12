/*publish date:2012-05-18 16:23:55*/

var map = "";  //地图对象
var b = "";    //标注对象
function initMap() {
    map = new BMap.Map(mapInfo.mapId);
    if (mapInfo.lon) {
        map.centerAndZoom(new BMap.Point(mapInfo.lon, mapInfo.lat), mapInfo.level)
    } else {
        var b = mapInfo.cityName ? mapInfo.cityName : "成都市";
        map.centerAndZoom(b, mapInfo.level)
    }
    map.enableScrollWheelZoom();
    var a = (mapInfo.isSmall) ? {
        type: BMAP_NAVIGATION_CONTROL_SMALL
    } : {};
    mapInfo.isFish && map.addControl(new BMap.NavigationControl(a));
    mapInfo.isOverview && map.addControl(new BMap.OverviewMapControl());
    if (mapInfo.lon) {
        showSingleMsg()
    }
}

//搜索地点定位
function funSearchMap(address) {
    if (address == "undefined" || address == "") {
        alert("请输入地址，再进行搜索！");
        return;
    }

    if (map == '' || map == 'undefined' || b == '') {
        return;
    }
    map.clearOverlays();

    //创建地址解析的实例
    var myGeo = new BMap.Geocoder();
    myGeo.getPoint(address, function (point) {
        if (point) {
            map.centerAndZoom(point, 16);
            b = new BMap.Marker(point);
            map.addOverlay(b);
            //b.enableDragging();

            var infoWindow = new BMap.InfoWindow(MapControl.infoWinContent, MapControl.infoOpts);  // 创建信息窗口对象   

            b.addEventListener("mouseover", function () {
                this.openInfoWindow(infoWindow);      // 打开信息窗口 
            })
            b.addEventListener("mouseout", function () {
                this.closeInfoWindow();      // 打开信息窗口 
            })
        }

    });

}

function startPoint() {
    map.addEventListener("click", handlePoint)
}
function handlePoint(b) {
    if (b.point) {
        map.clearOverlays();
        var a = new BMap.Marker(new BMap.Point(b.point.lng, b.point.lat));
        map.addOverlay(a);
        a.setAnimation(BMAP_ANIMATION_DROP);
        document.getElementById("mapData").value = b.point.lng + "," + b.point.lat
    } else {
        alert("地图标注失败,请重新标示");
        return false
    }
}
function showSingleMsg() {
    map.clearOverlays();
    var a = new BMap.Point(mapInfo.lon, mapInfo.lat);
    var remark = new BMap.Point(mapInfo.clon, mapInfo.clat);
    //var d = new BMap.Icon(mapInfo.icon, new BMap.Size(32, 32));
    var e = {
        width: mapInfo.msgWidth,
        height: mapInfo.msgHeight,
        title: mapInfo.msgTitle,
        offset: new BMap.Size(0, -15)
    };
    var c = new BMap.InfoWindow(mapInfo.msgContent, e);
    if (mapInfo.isMsg) {
        map.openInfoWindow(c, a)
    }
    b = new BMap.Marker(remark);
    //b.setIcon(d);
    map.addOverlay(b);

    b.addEventListener("click",
    function () {
        this.openInfoWindow(c)
    })
};


/*获取地图中心的经纬度*/
function getCenter() {
    if (map == '' || map == 'undefined' || b == '') {
        return;
    }
    var center = map.getCenter().lng + ',' + map.getCenter().lat;
    return center;
}


/*获取公司地图标注的经纬度*/
function getMarker() {
    if (map == '' || map == 'undefined' || b == '') {
        return;
    }
    var markers = b.getPosition().lng + ',' + b.getPosition().lat;
    return markers;
}

/*获取地图的级别*/
function getZoom() {
    if (map == '' || map == 'undefined' || b == '') {
        return;
    }
    var zoom = map.getZoom();
    return zoom;
}

/**
* 获取静态图片地址
*/
function getStaticMap() {
    if (map == '' || map == 'undefined' || b == '') {
        return;
    }
    var center = map.getCenter().lng + ',' + map.getCenter().lat;
    var markers = b.getPosition().lng + ',' + b.getPosition().lat;
    var zoom = map.getZoom();
    var staticmapstr = 'http://api.map.baidu.com/staticimage?center=' + center + '&markers=' + markers + '&zoom=' + zoom + '&width=' + MapControl.staticWith + '&height=' + MapControl.staticHeight;
    return staticmapstr;
}

//调用腾讯的接口得到城市(接口不可用)
function get_ip_place() {
    var ip = file_get_contents("http://fw.qq.com/ipaddress");
    ip = str_replace('"', ' ', ip);
    var ip2 = explode("(", ip);
    var a = substr(ip2[1], 0, -2);
    var b = explode(",", a);
    return b;
}