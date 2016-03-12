<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<section>
	<?php $i=0;?>
	<?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
	<?php if($i!=0) { ?>
	<img class="index_show" src="/uploadfile/show0<?php echo $i;?>.jpg" />
	<?php } ?>
	<div class="region">
		<h2><?php echo $c['catname'];?></h2>
		<div class="news_lists">
	        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9318450a5088434e6010f7b66799cd1c&action=lists&catid=%24c%5Bcatid%5D&num=8&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$c[catid],'order'=>'listorder DESC','limit'=>'8',));}?>
	        <ul>
	        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
	        <li class="news_list"><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'],43);?><span><?php echo date('Y-m-d',$r['inputtime']);?></span></a></li>
	        <?php $n++;}unset($n); ?>
	        </ul>   
	        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
        <div class="more"><a href="<?php echo $c['url'];?>">进入<?php echo $c['catname'];?>栏目</a></div>
	</div>
	<?php $i++;?>
	<?php $n++;}unset($n); ?>
</section>
<?php include template("content","footer"); ?>