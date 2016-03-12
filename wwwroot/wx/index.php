<?php
require_once('weixin.class.php');
$weixin = new class_weixin();
$signPackage = $weixin->GetSignPackage();

$news = array("Title" =>"微信公众平台开发实践", "Description"=>"本书共分10章，案例程序采用广泛流行的PHP、MySQL、XML、CSS、JavaScript、HTML5等程序语言及数据库实现。", "PicUrl" =>'http://images.cnitblog.com/i/340216/201404/301756448922305.jpg', "Url" =>'http://www.cnblogs.com/txw1958/p/weixin-development-best-practice.html');    

?>

<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="format-detection" content="telephone=no" />
  <title>方倍工作室</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="http://demo.open.weixin.qq.com/jssdk/css/style.css">
</head>
<body ontouchstart="">
<button class="btn btn_primary" id="checkJsApi">checkJsApi</button>
 JS SDK Demo 
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
	wx.config({
		debug: true,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			// 所有要调用的 API 都要加到这个列表中
			'checkJsApi',
			'openLocation',
			'getLocation',
			'onMenuShareTimeline',
			'onMenuShareAppMessage'
		  ]
	});
</script>

<script>
	wx.ready(function () {
		//自动执行的
		wx.checkJsApi({
			jsApiList: [
				'getLocation',
				'onMenuShareTimeline',
				'onMenuShareAppMessage'
			],
			success: function (res) {
				alert(JSON.stringify(res));
				// alert(JSON.stringify(res.checkResult.getLocation));
				// if (res.checkResult.getLocation == false) {
					// alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
					// return;
				// }
			}
		});
		
		
		wx.onMenuShareAppMessage({
		  title: '<?php echo $news['Title'];?>',
		  desc: '<?php echo $news['Description'];?>',
		  link: '<?php echo $news['Url'];?>',
		  imgUrl: '<?php echo $news['PicUrl'];?>',
		  trigger: function (res) {
			// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
			// alert('用户点击发送给朋友');
		  },
		  success: function (res) {
			// alert('已分享');
		  },
		  cancel: function (res) {
			// alert('已取消');
		  },
		  fail: function (res) {
			// alert(JSON.stringify(res));
		  }
		});

		wx.onMenuShareTimeline({
		  title: '<?php echo $news['Title'];?>',
		  link: '<?php echo $news['Url'];?>',
		  imgUrl: '<?php echo $news['PicUrl'];?>',
		  trigger: function (res) {
			// 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
			// alert('用户点击分享到朋友圈');
		  },
		  success: function (res) {
			// alert('已分享');
		  },
		  cancel: function (res) {
			// alert('已取消');
		  },
		  fail: function (res) {
			// alert(JSON.stringify(res));
		  }
		});
	});

	wx.error(function (res) {
		alert(res.errMsg);
	});
 </script>
</html>
