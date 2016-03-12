<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
		<div class="banner">
			<div class="hd_bg"></div>
			<div class="hd">
				<ul>
                	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5191fa687f808411becfb5e355fe30f7&action=position&posid=18&order=listorder+DESC&thumb=1&num=4&return=scrollImg\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$scrollImg = $content_tag->position(array('posid'=>'18','order'=>'listorder DESC','thumb'=>'1','limit'=>'4',));}?>
                    <?php $i=1;?>
					<?php $n=1;if(is_array($scrollImg)) foreach($scrollImg AS $r) { ?>
					<li><?php echo $i;?></li>
                    <?php $i++?>
                    <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
			<div class="bd">
				<ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5191fa687f808411becfb5e355fe30f7&action=position&posid=18&order=listorder+DESC&thumb=1&num=4&return=scrollImg\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$scrollImg = $content_tag->position(array('posid'=>'18','order'=>'listorder DESC','thumb'=>'1','limit'=>'4',));}?>
				<?php $n=1;if(is_array($scrollImg)) foreach($scrollImg AS $r) { ?>
				<li><a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>"/></a></li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</ul>
			</div>
		</div>
		<div class="content clearfix">
			<div class="con_left">
				<div class="index_left1 clearfix">
					<div class="left1_slide">
						 <ul class="bigImg">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ffebe6366fa08f23de5bef694d567e4f&action=lists&catid=18&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'3',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>" ><img src="<?php echo $dv['thumb'];?>" /><h4><?php echo str_cut($dv['title'],60);?></h4></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
						<div class="smallScroll">
							<div class="smallImg">
								<ul>
								<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ffebe6366fa08f23de5bef694d567e4f&action=lists&catid=18&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'3',));}?>
								<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
								<li><img src="<?php echo $dv['thumb'];?>" /></li>
								<?php $n++;}unset($n); ?>
								<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
								</ul>
							</div>
						</div>
					</div>
					<div class="left1_fr">
						<div class="left1_top1">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=20cf0a4ca65d8cb6807b2831d1b27e0b&action=lists&catid=18&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'1',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<a href="<?php echo $dv['url'];?>"><h2><?php echo str_cut($dv['title'],60);?></h2>
						<p><?php echo str_cut(strip_tags($dv[description]),200);?></p></a>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<div class="left1_title">
							<div class="left1_title_l"><em>TEAM</em><p>团队动态</p></div>
							<div class="left1_title_r"><a href="/index.php?m=content&c=index&a=lists&catid=18">更多>></a></div>
						</div>
						<div class="left1_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6c70c0e1956f81426a1fa50f7d4cc5c9&action=lists&catid=18&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'4',));}?>
							<?php $i=1;?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php $i++;?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
				</div>
				<div class="index_left2 clearfix">
					<div class="left_title clearfix">
						<h3>热点关注</h3>
						<span><a href="/index.php?m=content&c=index&a=lists&catid=24">更多>></a></span>
					</div>
					<div class="left2_slide">
						<div class="bd">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2b1e9fbe275de3ac91ce0bf00bbe516d&action=lists&catid=24&thumb=1&order=ID+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'24','thumb'=>'1','order'=>'ID DESC','limit'=>'5',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>" ><img src="<?php echo $dv['thumb'];?>" /></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
						<div class="hd"><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li></ul></div>
					</div>
					<div class="left_list">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e89de2d6c210e25d8041f872ecab0a4e&action=lists&catid=24&order=ID+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'24','order'=>'ID DESC','limit'=>'8',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],60);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
				<div class="index_left3 clearfix">
					<div class="half_left">
						<div class="left_title clearfix">
							<h3>行业动态</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=61">更多>></a></span>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4e3f9aa50c7a6589235e4294777cadb1&action=lists&catid=61&order=ID+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'61','order'=>'ID DESC','limit'=>'7',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
					<div class="half_right">
						<div class="left_title clearfix">
							<h3>新法速递</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=62">更多>></a></span>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d814269cf8cb5910d06d750510451a05&action=lists&catid=62&order=ID+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'62','order'=>'ID DESC','limit'=>'7',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
				</div>
                <div class="swf">
                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="740" height="102">
                    <param name="movie" value="<?php echo SKIN_PATH;?>images/home1.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="<?php echo SKIN_PATH;?>images/home1.swf" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="740" height="102"></embed>
                    </object>
                </div>
				<div class="index_left4 clearfix">
					<div class="half_left">
						<div class="left_title clearfix">
							<h3>精选案例</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=8">更多>></a></span>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a4cfcf3854bf590299cbb6a1dd246250&action=lists&catid=8&order=ID+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'8','order'=>'ID DESC','limit'=>'7',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
					<div class="half_right">
						<div class="left_title clearfix">
							<h3>精彩文书</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=63">更多>></a></span>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e6611c15fe54fdf4f775295e12703372&action=lists&catid=63&order=ID+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'63','order'=>'ID DESC','limit'=>'7',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
				</div>
                <div class="swf">
                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="740" height="102">
                    <param name="movie" value="<?php echo SKIN_PATH;?>images/home2.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="<?php echo SKIN_PATH;?>images/home2.swf" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="740" height="102"></embed>
                    </object>
                </div>
				<div class="index_left5 clearfix">
					<div class="half_left">
						<div class="left_title clearfix">
							<h3>法律论坛</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=25">更多>></a></span>
						</div>
						<div class="news_img clearfix">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c93740c067f1158a0e4c595c08ee30d9&action=lists&catid=25&order=ID+DESC&num=1&thumb=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'25','order'=>'ID DESC','thumb'=>'1','limit'=>'1',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<div class="news_img_l"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" /></a></div>
							<div class="news_img_r">
								<h4><?php echo str_cut($dv['title'],40);?></h4>
								<p><?php echo str_cut(strip_tags($dv[description]),130);?></p>
							</div>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=63f038ed56a388c8e3598887d5cf8053&action=lists&catid=25&order=ID+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'25','order'=>'ID DESC','limit'=>'8',));}?>
							<?php $i=1?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<?php if($i>1) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php } ?>
							<?php $i++?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
					<div class="half_right">
						<div class="left_title clearfix">
							<h3>合同范本</h3>
							<span><a href="/index.php?m=content&c=index&a=lists&catid=28">更多>></a></span>
						</div>
						<div class="news_img clearfix">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=88411d1bede1eb8b9b383a7c005e0558&action=lists&catid=28&order=ID+DESC&num=1&thumb=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'ID DESC','thumb'=>'1','limit'=>'1',));}?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<div class="news_img_l"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" /></a></div>
							<div class="news_img_r">
								<h4><?php echo str_cut($dv['title'],40);?></h4>
								<p><?php echo str_cut(strip_tags($dv[description]),130);?></p>
							</div>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
						<div class="left_list">
							<ul>
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ac86e3ea11a3dd89d315c4f826e1ef4d&action=lists&catid=28&order=ID+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'ID DESC','limit'=>'8',));}?>
							<?php $i=1?>
							<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
							<?php if($i>1) { ?>
							<li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],50);?><span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
							<?php } ?>
							<?php $i++?>
							<?php $n++;}unset($n); ?>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
							</ul>
						</div>
					</div>
				</div>
				<div class="index_left6">
					<div class="left_title clearfix">
						<h3>合作律师</h3>
						<span><a href="/index.php?m=content&c=index&a=lists&catid=58">更多>></a></span>
					</div>
					<div class="left6_imglist clearfix">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=826299379dc380f124061109cad55394&action=lists&catid=58&order=ID+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'58','order'=>'ID DESC','limit'=>'4',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><div class="pic"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" /></a></div><a href="<?php echo $dv['url'];?>"><p><?php echo str_cut($dv['title'],50);?></p><span><?php echo $dv['Area'];?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
				</div>
				<div class="index_left7">
					<div class="hd clearfix">
						<ul>
							<li>律师作用</li>
							<li>选聘律师</li>
							<li>律师服务</li>
							<li>办案流程</li>
							<li>律师收费</li>
						</ul>
					<div class="fixhd"></div>
					</div>
					<div class="bd">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f8de4aa6141db830d7f37ac9015e42d7&action=lists&catid=64&order=listorder+DESC%2Cinputtime+desc&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'64','order'=>'listorder DESC,inputtime desc','limit'=>'12',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
						<p><?php echo str_cut($dv['title'],50);?></p>
						<span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="left7_more"><a href="/index.php?m=content&c=index&a=lists&catid=64">查看更多</a></div>
						</ul>
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3375af7c6b8a3efb5cd66f38734bca76&action=lists&catid=65&order=listorder+DESC%2Cinputtime+desc&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'65','order'=>'listorder DESC,inputtime desc','limit'=>'12',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
						<p><?php echo str_cut($dv['title'],50);?></p>
						<span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="left7_more"><a href="/index.php?m=content&c=index&a=lists&catid=65">查看更多</a></div>
						</ul>
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=10759975bcf25249c13b25a185a14c1e&action=lists&catid=66&order=listorder+DESC%2Cinputtime+desc&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'66','order'=>'listorder DESC,inputtime desc','limit'=>'12',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
						<p><?php echo str_cut($dv['title'],50);?></p>
						<span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="left7_more"><a href="/index.php?m=content&c=index&a=lists&catid=66">查看更多</a></div>
						</ul>
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d27d5457d873290857a5f1c70e2482c4&action=lists&catid=67&order=listorder+DESC%2Cinputtime+desc&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'67','order'=>'listorder DESC,inputtime desc','limit'=>'12',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
						<p><?php echo str_cut($dv['title'],50);?></p>
						<span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="left7_more"><a href="/index.php?m=content&c=index&a=lists&catid=67">查看更多</a></div>
						</ul>
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4b1bd32b696db64b021fde241882b90e&action=lists&catid=68&order=listorder+DESC%2Cinputtime+desc&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'68','order'=>'listorder DESC,inputtime desc','limit'=>'12',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
						<p><?php echo str_cut($dv['title'],50);?></p>
						<span><?php echo date('Y/m/d',$dv['inputtime']);?></span></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="left7_more"><a href="/index.php?m=content&c=index&a=lists&catid=68">查看更多</a></div>
						</ul>
					</div>
				</div>
			</div>
			<div class="con_right">
				<div class="index_right1">
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
				<div class="index_right2">
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
				<div class="index_right3">
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
					<div class="right_more"><a href="/index.php?m=content&c=index&a=lists&catid=59">更多>></a></div>
				</div>
                <div class="weixin">
                <img src="<?php echo $CATEGORYS['97']['image'];?>" />
                </div>
				<div class="index_right4">
					<div class="right_title">荣誉资质</div>
					<div class="right4_list">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1345bca4d3b2c370f69ea64c4e3fb647&action=lists&catid=70&order=ID+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'70','order'=>'ID DESC','limit'=>'3',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" /></a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="right_more"><a href="/index.php?m=content&c=index&a=lists&catid=70">更多>></a></div>
				</div>
				<div class="index_right5">
					<div class="right_title">大记事</div>
					<div class="right5_list">
						<ul>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9b11aed73f3d016157768d09d6034ebd&action=lists&catid=71&order=ID+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'71','order'=>'ID DESC','limit'=>'3',));}?>
						<?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
						<li><a href="<?php echo $dv['url'];?>">
							<h4><?php echo str_cut($dv['title'],40);?></h4>
							<p><?php echo str_cut(strip_tags($dv[description]),150);?></p>
						</a></li>
						<?php $n++;}unset($n); ?>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</ul>
					</div>
					<div class="right_more"><a href="/index.php?m=content&c=index&a=lists&catid=71">更多>></a></div>
				</div>
				<div class="index_right6">
					<div class="right6_img"><a href="/index.php?m=content&c=index&a=lists&catid=73"><img src="<?php echo SKIN_PATH;?>images/laws.jpg" /></a></div>
					<div class="right6_search">
						<form name="form1" id="form1" action="index.php">
							<input type="hidden" name="m" value="content"/>
							<input type="hidden" name="c" value="index"/>
							<input type="hidden" name="a" value="lists"/>
							<input type="hidden" name="catid" value="73" id="catid"/>
							<input type="hidden" name="siteid" value="1" id="siteid"/>
							<input type="text" name="q" id="keywords" class="right6_text" value="法规搜索" onfocus="this.value=='法规搜索'?this.value='':''" onblur="this.value==''?this.value='法规搜索':''" />
							<input type="submit" id="post-search" class="right6_sub" value="搜索" />
						</form>
					</div>
				</div>
				<div class="index_right7">
					<div class="right7_img"><a href="/index.php?m=content&c=index&a=lists&catid=72"><img src="<?php echo SKIN_PATH;?>images/jion.jpg" /></a></div>
				</div>
			</div>
		</div>
<?php include template("content","footer"); ?>