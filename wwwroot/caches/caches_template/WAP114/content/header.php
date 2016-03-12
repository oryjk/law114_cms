<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" />
    <meta name="keywords" content="<?php echo $SEO['keyword'];?>" />
    <meta name="description" content="<?php echo $SEO['description'];?>"/>
    <title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/TouchSlide.1.1.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/common.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/nativeShare.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo SKIN_PATH;?>css/style.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SKIN_PATH;?>css/nativeShare.css" />
    <script>
		function show(){
			var display=$(".share").css('display');
			if(display=='none'){
				$(".share").show(500);
			}
			else{
				$(".share").hide(500);
			}
		}
	</script>
</head>

<body onResize="autoimg()">
<header id="header">
    <div class="logoarea clearfix">
        <div class="logo"><a href="/"><img src="<?php echo SKIN_PATH;?>images/logo.png"/></a></div>
        <div class="toptel"><a href="tel:400028164"><img src="<?php echo SKIN_PATH;?>images/TopTel.png"/></a></div>
        <div class="topQR"><img src="<?php echo SKIN_PATH;?>images/TopQR.png"/></div>
        <div class="topshare" id="topshare" onClick="show()"><img src="<?php echo SKIN_PATH;?>images/TopShare.png"/></div>
    </div>
        <div class="share" id="share">
            <div id="nativeShare"></div>
            <script>
			    var web_title='<?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?>';
				var web_desc='<?php echo $SEO['description'];?>';
				var web_url=window.location.href;
                var config = {
                    url:web_url,
                    title:web_title,
                    desc:web_desc,
                    img:'http://localhost:8051/phpcms/templates/WAP114/skin/images/logo.png',
                    img_title:web_title,
                    from:web_title,
                };
                var share_obj = new nativeShare('nativeShare',config);
            </script>
        </div>
    <div class="nav clearfix">
        <ul>
        <li><a href="/">网站首页</a></li>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3d2ac86e151b711aceab884d29e44c36&action=category&catid=0&order=listorder\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','order'=>'listorder','limit'=>'20',));}?>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        <?php if($r["isindexguide"]==1) { ?>
        <li><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a><li>
        <?php } ?>
        <?php $n++;}unset($n); ?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
    </div>
    <div id="slidebox" class="slidebox">
        <div class="bd">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=db45516e25e53fd349d03349f59c4199&action=position&posid=1&order=listorder+DESC&thumb=1&num=5&return=scrollImg\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$scrollImg = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','thumb'=>'1','limit'=>'5',));}?>
            <?php $n=1;if(is_array($scrollImg)) foreach($scrollImg AS $r) { ?>
            <li><a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>"/></a></li>
            <?php $n++;}unset($n); ?>            
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>            
            </ul>
        </div>
        <div class="hd">
            <ul></ul>
        </div>
    </div>
    <script>
        TouchSlide({ 
            slideCell:"#slidebox",
            titCell:".hd ul",
            mainCell:".bd ul", 
            effect:"leftLoop", 
            autoPage:true,
            autoPlay:true
        });
    </script>
</header>