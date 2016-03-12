<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('content', 'header_mini'); ?>
	<link type="text/css" rel="stylesheet" href="<?php echo SKIN_PATH;?>css/search.css" />
	<script language="javascript" src="<?php echo SKIN_PATH;?>js/search_common.js"></script>
    <div id="content"  data-ajax="false" data-role='none'>
    	<div class="sr_main">

            <div class="wrap sr_lists">
            	<div class="l">
                	<div>
                        <ul>
                        <li>网页结果</li>
						<li><a href="?m=search&c=index&a=init&typeid=1&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=<?php echo $time;?>" <?php if(1==$typeid) { ?> class="ac"<?php } ?>>文章</a></li>
						<li><a href="?m=search&c=index&a=init&typeid=3&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=<?php echo $time;?>" <?php if(3==$typeid) { ?> class="ac"<?php } ?>>图片</a></li>
                         </ul>
                    </div>
                    <!--<div>
                        <ul>
                            <li>时间搜索</li>
                            <li><a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=all" <?php if($time=='all' || empty($time)) { ?>class="ac"<?php } ?>>不限</a></li>
                            <li><a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=day" <?php if($time=='day') { ?>class="ac"<?php } ?>>一天内</a></li>
                            <li><a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=week" <?php if($time=='week') { ?>class="ac"<?php } ?>>一周内</a></li>
                            <li><a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=month" <?php if($time=='month') { ?>class="ac"<?php } ?>>一月内</a></li>
                            <li><a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&q=<?php echo urlencode($search_q);?>&siteid=<?php echo $siteid;?>&time=year" <?php if($time=='year') { ?>class="ac"<?php } ?>>一年内</a></li>
                        </ul>
                    </div>-->
                    <!--<div class="bgno">
                    	<span>搜索历史</span>
                        <ul id='history_ul'>
                        </ul>
                    </div>-->
                    <div class="clear"></div>
                </div>
                <div class="c wrap">
                	<ul class="wrap">
						<?php $n=1; if(is_array($data)) foreach($data AS $i => $r) { ?>
						<li class="wrap">
							<div>
								<?php if($r['thumb']) { ?><a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>" width="60" height="60" /></a><?php } ?>
								<h5><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a><?php if($r['posids']) { ?><img src="<?php echo IMG_PATH;?>icon/small_elite.gif"><?php } ?></h5>
								<p><?php echo $r['description'];?></p>
							</div>
							<!--<div class="adds">发布时间：<?php echo format::date($r[inputtime], 1);?></div>-->
						</li>
						<?php $n++;}unset($n); ?>
						<?php if(empty($data)) { ?><li>未找到结果</li><?php } ?>
                    </ul>
                    <div id="pages" class="text-c mg_t20" align="center"><?php echo $pages;?></div>
					<?php if($setting['relationenble']) { ?>
					<div class="wrap sgch"><strong>相关搜索：</strong>
					<?php $n=1; if(is_array($relation)) foreach($relation AS $k => $v) { ?>
					<a href="?m=search&c=index&a=init&typeid=<?php echo $typeid;?>&siteid=<?php echo $siteid;?>&q=<?php echo $v['keyword'];?>"><?php echo $v['keyword'];?></a> 
					<?php $n++;}unset($n); ?>
					</div>
					<?php } ?>
                </div>
            </div>
      </div>
</div>      
<script type="text/javascript" src="<?php echo JS_PATH;?>mobile/cookie.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>mobile/search_history.js"></script>
<?php if($setting['suggestenable']) { ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>mobile/jquery.suggest.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>mobile/search_suggest.js"></script>
<?php } ?>
<?php include template('content', 'footer_mini'); ?>
