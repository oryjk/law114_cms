<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_c"); ?>
	<div class="content clearfix">
		<div class="list_left">
			<div class="list_title">
				<h3><?php echo $CATEGORYS[$catid]['catname'];?></h3>
				<span><a href="/">首页 </a><?php echo catpos($catid,'>');?></span>
			</div>
			<div class="all_list">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b6ecda21fed20f1c6794ba9d4e5ac79c&action=lists&catid=%24catid&num=9&order=listorder+DESC%2Cinputtime+desc&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 9;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder DESC,inputtime desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC,inputtime desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <div class="item clearfix">
            	<div class="pic">
            	<a href="<?php echo $r['url'];?>">
                <?php if($r[thumb]) { ?>
                <img src="<?php echo $r['thumb'];?>" />
                <?php } else { ?>
                <img src="/uploadfile/noimage.jpg" />
                <?php } ?>
                </a>
                </div>
                <a href="<?php echo $r['url'];?>"><h3><?php echo str_cut($r['title'],80);?></h3></a>
                <p><?php echo str_cut(strip_tags($r[description]),300);?></p>
                <i>发布日期：<?php echo date('Y-m-d',$r['inputtime']);?></i><em><a href="<?php echo $r['url'];?>">阅读全文</a></em>
                <div class="clear"></div>
            </div>
			<?php $n++;}unset($n); ?>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <div class="pages" align="center"><?php echo $pages;?></div>
			</div>
		</div>
		<div class="show_right">
			<div class="show_right1">
				<form name="form1" id="form1" action="index.php">
					<input type="hidden" name="m" value="search"/>
					<input type="hidden" name="c" value="index"/>
					<input type="hidden" name="a" value="init"/>
					<input type="hidden" name="typeid" value="0" id="typeid"/>
					<input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid"/>
					<input type="text" name="q" id="keywords" class="searchtext" >
					<input type="submit" id="post-search" class="searchsub" value="搜索">
				</form>
			</div>
			<div class="show_right2">
				<div class="right_title">首席律师</div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=730d26f8bb7be78923d00f628deda576&action=lists&catid=57&order=ID+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'57','order'=>'ID DESC','limit'=>'1',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
				<div class="right2_show">
                            <div class="pic">
                            <a href="<?php echo $dv['url'];?>">
                            <img src="<?php echo $dv['thumb'];?>" />
                            </a>
                            </div>
                            <div class="txt">
                            <h4><a href="<?php echo $dv['url'];?>"><?php echo $dv['title'];?> <?php echo $dv['Area'];?></a></h4><p><?php echo str_cut(strip_tags($dv[description]),80);?></p>
                            </div>
                </div>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
            <div class="weixin">
            <img src="<?php echo $CATEGORYS['97']['image'];?>" />
            </div>
			<div class="show_right3">
				<div class="right_title"><a href="/index.php?m=content&c=index&a=lists&catid=18">团队动态</a></div>
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2c528ce84353ac1b3c2178a775e7068c&action=lists&catid=18&order=listorder+DESC%2Cinputtime+desc&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC,inputtime desc','limit'=>'7',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<div class="show_right3">
				<div class="right_title"><a href="/index.php?m=content&c=index&a=lists&catid=25">法律论坛</a></div>
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=80c27a44c1380321adf571ce302695ca&action=lists&catid=25&order=listorder+DESC%2Cinputtime+desc&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'25','order'=>'listorder DESC,inputtime desc','limit'=>'7',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<div class="show_right3">
				<div class="right_title"><a href="/index.php?m=content&c=index&a=lists&catid=8">精选案例</a></div>
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c617437c4e099a2b18e43ac3c20ba381&action=lists&catid=8&order=listorder+DESC%2Cinputtime+desc&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'8','order'=>'listorder DESC,inputtime desc','limit'=>'7',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<div class="show_right3">
				<div class="right_title"><a href="/index.php?m=content&c=index&a=lists&catid=28">合同范本</a></div>
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1ed76893197d3be2848cf23518130bec&action=lists&catid=28&order=listorder+DESC%2Cinputtime+desc&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'listorder DESC,inputtime desc','limit'=>'7',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php include template("content","footer"); ?>