<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<section>
    <div class="region">
        <h2><?php echo $CATEGORYS[$catid]['catname'];?></h2>
        <div class="content clearfix" >
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=08b73d4107335c862f85c0d7ca03a052&action=lists&catid=%24catid&num=15&order=listorder+DESC&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
            <ul>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <li class="news_list"><a href="<?php echo $r['url'];?>"><?php echo str_cut($r['title'],43);?><span><?php echo date('Y-m-d',$r['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            </ul>   
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <div class="pages"><?php echo $pages;?></div>
        </div>
    </div>
</section>
<?php include template("content","footer"); ?>