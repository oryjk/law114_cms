<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_a"); ?>
	<div class="content">
		<div class="c_left">
			<div class="c_left1 clearfix">
				<div class="left1_slide">
					 <ul class="bigImg">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=401ecc365c7d4bef762b53b101178328&action=lists&catid=%24catid&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC','limit'=>'20',));}?>
					<?php $i=1?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<?php if($dv['thumb'] && $i<4) { ?>
					<li><a href="<?php echo $dv['url'];?>" ><img src="<?php echo $dv['thumb'];?>" /></a></li>
					<?php $i++;?>
					<?php } ?>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
					<div class="smallScroll">
						<div class="smallImg">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3d64ff767eadedc59265dca093415e96&action=lists&catid=%24catid&order=listorder+DESC%2Cinputtime+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC,inputtime desc','limit'=>'20',));}?>
							<?php $i=1?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<?php if($dv['thumb'] && $i<4) { ?>
							<li><img src="<?php echo $dv['thumb'];?>" /></li>
							<?php $i++;?>
							<?php } ?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
				</div>
				<div class="left1_fr">
					<div class="left1_top1">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=af5abd38fdbd8e49d07ce6bc7002ba9b&action=lists&catid=%24catid&order=listorder+DESC%2Cinputtime+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC,inputtime desc','limit'=>'1',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<a href="<?php echo $dv['url'];?>"><h2><?php echo str_cut($dv['title'],60);?></h2>
					<p><?php echo str_cut(strip_tags($dv[description]),200);?></p></a>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
            		<div class="left1_slideTxtBox">
                        <div class="hd">
                            <ul>
                            <?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
                                <?php if($c['ismenu']==0) { ?>
                                <li><?php echo $c['catname'];?></li>
                                <?php } ?>
                            <?php $n++;}unset($n); ?>
                            </ul>
                        </div>
                        <div class="bd">
                        	<?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
                            <?php if($c['ismenu']==0) { ?>
                            <ul>
                                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4faae2c92fda5e76f502e2e196aaf3a3&action=lists&catid=%24c%5Bcatid%5D&num=4&order=listorder+DESC%2Cinputtime+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$c[catid],'order'=>'listorder DESC,inputtime desc','limit'=>'4',));}?>
				        		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<li><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'],50);?><span><?php echo date('Y/m/d',$r['inputtime']);?></span></a></li>
				        		<?php $n++;}unset($n); ?>
				        		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                            </ul>
                            <?php } ?>
                            <?php $n++;}unset($n); ?>
                        </div>
                    </div>
                    <script type="text/javascript">jQuery(".left1_slideTxtBox").slide({trigger:"click"});</script>
				</div>
			</div>
			<div class="c_left2 clearfix">
				<?php $i=1;?>
				<?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
                <?php if($c['ismenu']==1) { ?>
				<div class="<?php if($i%2==1) { ?>half_left<?php } else { ?>half_right<?php } ?>">
					<div class="left_title clearfix">
						<h3><?php echo $c['catname'];?></h3>
						<span><a href="<?php echo $c['url'];?>">查看更多>></a></span>
					</div>
					<div class="left_list">
						<ul>
				        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f8ae938942cd85568c848a9149a21075&action=lists&catid=%24c%5Bcatid%5D&num=7&order=listorder+DESC%2Cinputtime+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$c[catid],'order'=>'listorder DESC,inputtime desc','limit'=>'7',));}?>
				        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'],50);?><span><?php echo date('Y/m/d',$r['inputtime']);?></span></a></li>
				        <?php $n++;}unset($n); ?>
				        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
                <?php if($i%2==0&&$i<8) { ?>
                <script language="javascript" src="<?php echo APP_PATH;?>index.php?m=poster&c=index&a=show_poster&id=10"></script>
                <?php } ?>
                <?php } ?>
				<?php $i++;?>
				<?php $n++;}unset($n); ?>
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
				<div class="right_title">最新行业法规</div>
				<div class="right3_list">
					<ul>
                    <?php $child=$CATEGORYS[73][arrchildid]?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f3a8af020dc34fc2fd6dec0e4582f0b1&action=lists&catid=73&where=catid+in+%28%24child%29+and+RelactionCat%3D%24catid&order=listorder+DESC%2Cinputtime+desc&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'73','where'=>"catid in ($child) and RelactionCat=$catid",'order'=>'listorder DESC,inputtime desc','limit'=>'6',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<div class="show_right3">
				<div class="right_title"><a href="/index.php?m=content&c=index&a=lists&catid=18">团队动态</a></div>
				<div class="right3_list">
					<ul>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8d2afed9826682cf1c88fda624afd80d&action=lists&catid=18&order=listorder+DESC%2Cinputtime+desc&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC,inputtime desc','limit'=>'6',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
				<div class="show_right6">
					<div class="right6_img"><a href="/index.php?m=content&c=index&a=lists&catid=73"><img src="<?php echo SKIN_PATH;?>images/laws.jpg" /></a></div>
					<div class="right6_search">
						<form name="form1" id="form1" action="index.php">
							<input type="hidden" name="m" value="search"/>
							<input type="hidden" name="c" value="index"/>
							<input type="hidden" name="a" value="init"/>
							<input type="hidden" name="typeid" value="53" id="typeid"/>
							<input type="hidden" name="siteid" value="1" id="siteid"/>
							<input type="text" name="q" id="keywords" class="right6_text" value="法规搜索" onfocus="this.value=='法规搜索'?this.value='':''" onblur="this.value==''?this.value='法规搜索':''" />
							<input type="submit" id="post-search" class="right6_sub" value="搜索" />
						</form>
					</div>
				</div>
				<div class="show_right7">
					<div class="right7_img"><a href="/index.php?m=content&c=index&a=lists&catid=72"><img src="<?php echo SKIN_PATH;?>images/jion.jpg" /></a></div>
				</div>
            <?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
            <?php if($c['ismenu']==2) { ?>
			<div class="show_right3">
				<div class="right_title"><a href="<?php echo $c['url'];?>"><?php echo $c['catname'];?></a></div>
				<div class="right3_list">
					<ul>
                    <?php $c_catid=$c['catid']?>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7b9a7c2e7808c529dd88dcb41e678c1c&action=lists&catid=%24c_catid&order=listorder+DESC%2Cinputtime+desc&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$c_catid,'order'=>'listorder DESC,inputtime desc','limit'=>'6',));}?>
					<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
					<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
					<?php $n++;}unset($n); ?>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
			</div>
			<?php } ?>
            <?php $n++;}unset($n); ?>

		</div>
	</div>
<?php include template("content","footer"); ?>