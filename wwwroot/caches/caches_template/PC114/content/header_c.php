<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="keywords" content="<?php echo $SEO['keyword'];?>" />
    <meta name="description" content="<?php echo $SEO['description'];?>"/>
    <title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
    <link type="text/css" href="<?php echo SKIN_PATH;?>css/base.css" rel="stylesheet"/>
    <link type="text/css" href="<?php echo SKIN_PATH;?>css/inner.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/jquery.SuperSlide.2.1.1.js"></script>
    <script type="text/javascript" src="<?php echo SKIN_PATH;?>js/script.js"></script>
    <script>
		$(document).ready(function(){ 
			var divcss = {
				background: 'none',
				width:'40px',
				height:'40px',
				overflow:'inherit',
				padding:'0px',
			};
		　　$("#ckepop a .jtico").css(divcss); 
		}); 
	</script>
	<script type="text/javascript">
    function SetHome(obj,url){
      try{
        obj.style.behavior='url(#default#homepage)';
        obj.setHomePage(url);
      }catch(e){
        if(window.netscape){
         try{
           netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
         }catch(e){
           alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
         }
        }else{
        alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。");
        }
     }
    }
      
    function AddFavorite(title, url) {
     try {
       window.external.addFavorite(url, title);
     }
    catch (e) {
       try {
        window.sidebar.addPanel(title, url, "");
      }
       catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请进入新网站后使用Ctrl+D进行添加");
       }
     }
    }
    </script>
</head>
<body onload="myfunction()">
    <div id="header" class="clearfix">
        <div class="topline main clearfix">
            <span>欢迎来到四川民商律师网!</span>
            <span class="hrefs"><a href="javascript:void(0);" onClick="SetHome(this,'http://www.law114.net.cn/');">设为首页</a>|<a href="javascript:void(0);" onClick="AddFavorite('<?php echo $SEO['site_title'];?>','http://www.law114.net.cn/')">加入收藏</a></span>
        </div>
        <div class="logoarea main clearfix">
            <div class="logo"><a href="/"><img src="<?php echo SKIN_PATH;?>images/logo.png" /></a></div>
			<div class="share_button">
                <!-- JiaThis Button BEGIN -->
                <div id="ckepop">
                <a class="jiathis_button_weixin"><img src="<?php echo SKIN_PATH;?>images/top_icon2.png" class="vosh"/></a> 
                </div> 
                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1" charset="utf-8"></script>
                <!-- JiaThis Button END -->
                <img src="<?php echo SKIN_PATH;?>images/top_icon1.png" class="voqr"/>
                <div class="qr"><iframe src="/index.php?m=content&c=index&a=kefu" frameborder="0" style="overflow:hidden"></iframe></div>
            </div>
            <div class="tel"><img src="<?php echo SKIN_PATH;?>images/tel.png" /></div>
        </div>
        <div class="nav main clearfix">
        <ul>
        <li><a href="/">首页</a></li>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d83b55424ff0521d6747ff3c090b821f&action=category&catid=0&order=listorder&return=nav\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$nav = $content_tag->category(array('catid'=>'0','order'=>'listorder','limit'=>'20',));}?>
        <?php $n=1;if(is_array($nav)) foreach($nav AS $c) { ?>
            <?php if($c["isindexguide"]==1) { ?>
            <li <?php if(subcat($c['catid'])) { ?>class="m"<?php } ?>>
                <a href="<?php echo $c['url'];?>"><?php echo $c['catname'];?></a>
                <?php if(subcat($c['catid'])) { ?>
                <ul class="sub">
                <?php $n=1;if(is_array(subcat($c['catid']))) foreach(subcat($c['catid']) AS $c2) { ?>
                    <?php if($c2['ismenu']==1) { ?>
                    <li><a href="<?php echo $c2['url'];?>"><?php echo $c2['catname'];?></a></li>
                    <?php } ?>
                <?php $n++;}unset($n); ?>
                </ul>
                <?php } ?>
            </li>
            <?php } ?>
        <?php $n++;}unset($n); ?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </ul>
        </div>
    </div>
    <div id="wrapper" class="main clearfix">
        <div class="inner_banner clearfix">
            <div class="bd">
                <ul>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b3a7cbf88efc750e2333acc3d2c61cad&action=position&posid=19&order=listorder+DESC&thumb=1&num=4&return=scrollImg\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$scrollImg = $content_tag->position(array('posid'=>'19','order'=>'listorder DESC','thumb'=>'1','limit'=>'4',));}?>
                <?php $n=1;if(is_array($scrollImg)) foreach($scrollImg AS $r) { ?>
                <li><a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>"/></a></li>
                <?php $n++;}unset($n); ?>            
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </ul>
            </div>
        </div>