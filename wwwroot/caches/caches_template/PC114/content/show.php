<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_c"); ?>
	<div class="content clearfix">
		<div class="show_left">
			<div class="show_title">
				<h3><?php echo $CATEGORYS[$catid]['catname'];?></h3>
				<span><a href="/">首页 </a><?php echo catpos($catid,'>');?></span>
			</div>
			<div class="a_title"><?php echo $title;?></div>
			<div class="a_time">发布时间：<?php echo $inputtime;?></div>
			<div class="show_con"><?php echo $content;?></div>
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
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=10ea54b9c3959af4522d5bb68c15c418&action=lists&catid=18&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'6',));}?>
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
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a6dd81cfb3a393368c6a8ceb87de8deb&action=lists&catid=25&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'25','order'=>'listorder DESC','limit'=>'6',));}?>
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
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8e1c43ca4109b3a5809117c1b18a1126&action=lists&catid=8&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'8','order'=>'listorder DESC','limit'=>'6',));}?>
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
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c452e95a36a72a968570479c1bb42888&action=lists&catid=28&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'listorder DESC','limit'=>'6',));}?>
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