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
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=B605c6b7d306d1119709ab461bac0fa3"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo SKIN_PATH;?>css/style.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo SKIN_PATH;?>css/map.css" />
</head>

<body onResize="autoimg()">
<header id="header">
    <div class="logoarea clearfix">
        <div class="logo"><a href="/"><img src="<?php echo SKIN_PATH;?>images/logo.png"/></a></div>
        <div class="toptel"><a href="tel:400028164"><img src="<?php echo SKIN_PATH;?>images/TopTel.png"/></a></div>
        <div class="topQR"><img src="<?php echo SKIN_PATH;?>images/TopQR.png"/></div>
        <div class="topshare"><img src="<?php echo SKIN_PATH;?>images/TopShare.png"/></div>
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
</header>