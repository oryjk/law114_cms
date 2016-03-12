/**
加载地图的主控类
*/
var MapControl = {
    staticWith: 512, //链接静态图宽度
    staticHeight: 320, //链接静态图的高度
    container: 'mapcontainer', //显示map的节点id
    defzoom: 12, //默认缩放比例
    map: '',
    marker: '',
    city: '郑州',
    //city: '113.649644,34.75661',
    infoWinContent: '请移动此标记到贵公司的所在位置！',
    /**
    提示信息窗内容
    */
    infoOpts: {
        width: 100,     // 信息窗口宽度   
        height: 50,     // 信息窗口高度  
        title: "提示："  // 信息窗口标题   
    },


    /**
    *默认显示窗口
    */
    defWindow: function (point) {
        this.map = new BMap.Map(this.container);
        this.map.centerAndZoom(this.city, this.defzoom);  // 通过城市名初始化地图  
        this.map.enableScrollWheelZoom();  //启用地图滚轮放大缩小

        this.map.addEventListener("load", function () {
            // 初始化方法执行完成后即可获取地图中心点信息   
            MapControl.marker = new BMap.Marker(this.getCenter());        // 创建标注   
            this.addOverlay(MapControl.marker);                     // 将标注添加到地图中  
            MapControl.marker.enableDragging();
            var infoWindow = new BMap.InfoWindow(MapControl.infoWinContent, MapControl.infoOpts);  // 创建信息窗口对象   
            MapControl.marker.addEventListener("mouseover", function () {
                this.openInfoWindow(infoWindow);      // 打开信息窗口 
            })
            MapControl.marker.addEventListener("mouseout", function () {
                this.closeInfoWindow();      // 打开信息窗口 
            })
        })

        //map 增加操作
        this.map.addControl(new BMap.NavigationControl());
        this.map.addControl(new BMap.ScaleControl());
        this.map.addControl(new BMap.OverviewMapControl());
        this.map.addControl(new BMap.MapTypeControl());
    },

    //将具体地址转化为坐标创建地图
    adressToPoint: function (address, oMap) {
        oMap.removeOverlay(MapControl.marker); //定位新的标注时，清除之前的标注

        //创建地址解析的实例
        var myGeo = new BMap.Geocoder();
        myGeo.getPoint(address, function (point) {
            if (point) {
                oMap.centerAndZoom(point, 15);

                MapControl.marker = new BMap.Marker(point);        // 创建标注   
                oMap.addOverlay(MapControl.marker);                     // 将标注添加到地图中  
                MapControl.marker.enableDragging();
                var infoWindow = new BMap.InfoWindow(MapControl.infoWinContent, MapControl.infoOpts);  // 创建信息窗口对象   
                MapControl.marker.addEventListener("mouseover", function () {
                    this.openInfoWindow(infoWindow);      // 打开信息窗口 
                })
                MapControl.marker.addEventListener("mouseout", function () {
                    this.closeInfoWindow();      // 打开信息窗口 
                })
            }
        }, "全国");

    },
    /**
    * 搜索地址
    */
    search: function (address) {
        if (this.map == '' || this.map == 'undefined' || address == '') {
            return;
        }
        //this.city = address;
        //this.defWindow();
        this.adressToPoint(address, this.map);

    },

    /**
    * 获取静态图片地址
    */
    getStaticMap: function () {
        if (this.map == '' || this.map == 'undefined' || this.marker == '') {
            return;
        }
        var center = this.map.getCenter().lng + ',' + this.map.getCenter().lat;
        var markers = this.marker.getPosition().lng + ',' + this.marker.getPosition().lat;
        var zoom = this.map.getZoom();
        var staticmapstr = 'http://api.map.baidu.com/staticimage?center=' + center + '&markers=' + markers + '&zoom=' + zoom + '&width=' + this.staticWith + '&height=' + this.staticHeight;
        return staticmapstr;
    }
    ,

    /*获取地图中心的经纬度*/
    getCenter: function () {
        if (this.map == '' || this.map == 'undefined' || this.marker == '') {
            return;
        }
        var center = this.map.getCenter().lng + ',' + this.map.getCenter().lat;
        return center;
    },
    /*获取公司地图标注的经纬度*/
    getMarker: function () {
        if (this.map == '' || this.map == 'undefined' || this.marker == '') {
            return;
        }
        var markers = this.marker.getPosition().lng + ',' + this.marker.getPosition().lat;
        return markers;
    },
    getZoom: function () {

        if (this.map == '' || this.map == 'undefined' || this.marker == '') {
            return;
        }
        var zoom = this.map.getZoom();
        return zoom;
    }
    ,

    /**
    * 绑定 Event
    */
    bindEvent: function (btnsearch, txtaddress) {
        //binding mapsearch
        var mapsearch = document.getElementById(btnsearch);
        mapsearch.onclick = function () {
            var address = document.getElementById(txtaddress).value;

            if (address == "undefined" || address == "") {
                alert("请输入地址，再进行搜索！");
                return;
            }
            MapControl.search(address);
        }
    },

    /**
    * initMap
    */
    initMap: function (btnsearch, txtaddress) {

        this.bindEvent(btnsearch, txtaddress);
        this.defWindow();
    }
}


