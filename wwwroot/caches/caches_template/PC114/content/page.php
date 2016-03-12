<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_c"); ?>
	<div class="content clearfix">
		<div class="page_left">
			<div class="page_title">
				<h3><?php echo $CATEGORYS[$catid]['catname'];?></h3>
				<span><a href="/">首页 </a><?php echo catpos($catid,'>');?></span>
			</div>
			<div class="page_con"><?php echo $content;?></div>
		</div>
		<div class="page_right">
			<div class="page_right1">
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
			<div class="page_right2">
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
			<div class="page_right3">
				<div class="right_title">精英律师</div>  
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ed03ade085014ef629097acd31f02486&action=lists&catid=59&order=ID+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'59','order'=>'ID DESC','limit'=>'4',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li>
                            <div class="pic">
                            <a href="<?php echo $dv['url'];?>">
                            <img src="<?php echo $dv['thumb'];?>" />
                            </a>
                            </div>
                            <div class="txt">
                            <h4><a href="<?php echo $dv['url'];?>"><?php echo $dv['title'];?> <?php echo $dv['Area'];?></a></h4><p><?php echo str_cut(strip_tags($dv[description]),80);?></p>
                            </div>
                    </li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				<div class="right_more"><a href="/index.php?m=content&c=index&a=lists&catid=59">[查看更多]</a></div>
			</div>
		</div>
	</div>
<?php include template("content","footer"); ?>