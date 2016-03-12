<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_map"); ?>
<div id="loading"></div><div id="l-map"></div><div class="clear"></div><div style="background:white; padding:5px;"><div class="tab-tip"id="travl-method"><a href="javascript:;"id="TransitRoute"class="cur">公交</a><a href="javascript:;"id="DrivingRoute">驾车</a></div><div class="tab-con">起点：<span id="failSpan">自动定位失败，请输入起点地址（城市街名号）</span><br/><input type="text"id="l-begin"name="l-begin"data-role="none"/><br/>终点：<br/><input type="text"id="l-end"name="l-end"value="<?php echo $map_info['address'];?>"data-role="none"/>&nbsp;&nbsp;<input type="button"id="l-confirm"value="确定"data-role="none"/></div></div><div id="r-result"></div><?php include template("content","footer"); ?>
<script type="text/javascript">
$(window).resize(function() {
  $("#l-map").css("height",$(window).height()*0.5+"px");
});
$("#l-map").css("height",$(window).height()*0.5+"px");
var map = new BMap.Map("l-map");
var transit = null,geol = false,gpsEnable = true,loadTimer,city="",TFlag=true,loc="";
var $lbegin = $('#l-begin'),
$lend = $('#l-end'),
$method = $('#travl-method a');
var $met = $('input[name=l-method]');
var pEnd = new BMap.Point(<?php echo $mark_map['0'];?>, <?php echo $mark_map['1'];?>);
var pCenter = new BMap.Point(<?php echo $center_map['0'];?>,<?php echo $center_map['1'];?>);
var TransitRoute=new BMap.TransitRoute(map,{renderOptions:{map: map,panel: "r-result",enableDragging : true}});
var DrivingRoute=new BMap.DrivingRoute(map,{renderOptions:{map: map,panel: "r-result",enableDragging : true}});
map.centerAndZoom( pCenter , <?php echo $map_info['zoom'];?>);
MarkIt();
$('#l-confirm').bind('click',function() {
    $('#travl-method a.cur').trigger('click')
});
$method.bind('click',function() {
	$('#l-map').css("z-index",100);
    $('#loading').show();
    $(this).addClass('cur').siblings().removeClass();
	if ($(this).attr('id')=="TransitRoute"){
		transit=TransitRoute;
		//BMap.removeOverlay(DrivingRoute);
		DrivingRoute.clearResults();
	}else{
		transit=DrivingRoute;
		//BMap.removeOverlay(TransitRoute);
		TransitRoute.clearResults();
	}
	
    myTransit();
    loadTimer = setInterval(function() {
        if (geol) {
            $('#loading').hide();
            clearInterval(loadTimer)
        }
    },
    1000)
}).eq(0).trigger('click');
function MarkIt(){
	map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
	var marker1 = new BMap.Marker(pEnd);  // 创建标注
	map.addOverlay(marker1);              // 将标注添加到地图中
	marker1.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
	//创建信息窗口
	var infoWindow1 = new BMap.InfoWindow("<?php echo $map_info['address_tag'];?><br /><?php echo $map_info['address'];?>");
	marker1.addEventListener("click", function(){this.openInfoWindow(infoWindow1);});
}
function myTransit() {
	$("#failSpan").hide();
    geol = false;
	if (loc==""||(loc!=""&&loc==$lbegin.val())){
		var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function(r) {
			if (geolocation.getStatus() == BMAP_STATUS_SUCCESS) {
				var point = new BMap.Point(r.point.lng, r.point.lat);
				transit.search(point, pEnd);
				var gc = new BMap.Geocoder();
				gc.getLocation(point,
				function(rs) {
					var addComp = rs.addressComponents;
					var myPosAddr = addComp.province + addComp.city + addComp.district + addComp.street;
					city=addComp.city;
					loc=myPosAddr;
					if ($lbegin.val() == '') $lbegin.val(myPosAddr);
				});
				geol = !geol;
			}
		},
		{
			enableHighAccuracy: true
		});
	}
	
	if (!gpsEnable){
		locToTrans();
	}else{
		setTimeout(function() {
			if (!geol) {
				gpsEnable=false;
				locToTrans();
			}
		},
		5000)
	}
}
function locToTrans(){
	$("#failSpan").html("未找到，请输入起点详细地址（城市街名号）");
	if ($lbegin.val() == '') {
		$("#failSpan").show();
		$('#loading').hide();
		$lbegin.focus();
		return
	} else {
		if ($lbegin.val()!=""&&$lbegin.val().indexOf("市")<0)$lbegin.val("成都市"+$lbegin.val());
		var myGeo = new BMap.Geocoder();
		myGeo.getPoint($lbegin.val(),
		function(point) {
			if (point) {
				transit.search(point, pEnd);
				geol = !geol;
			}else{
				$("#failSpan").show();
				$('#loading').hide();
			}
		},
		city)
	}
}
</script>