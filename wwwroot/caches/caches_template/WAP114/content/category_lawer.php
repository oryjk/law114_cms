<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<section>
    <div class="region">
        <h2><?php echo $CATEGORYS[$catid]['catname'];?></h2>
        <div class="content clearfix" >
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=61ddf750b87e69a36de0c5d3241165f1&action=lists&catid=%24catid&num=10&order=listorder+ASC&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 10;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder ASC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder ASC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                <ul>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="img_list clearfix"><a href="<?php echo $r['url'];?>">
                <?php if($r['thumb']) { ?>
                    <img src="<?php echo $r['thumb'];?>" onload="autoimg()" class="imgauto2"/>
                <?php } else { ?>
                    <img src="/uploadfile/nopic.png" onload="autoimg()" class="imgauto2"/>
                <?php } ?>
                    <p><?php echo str_cut($r['title'],43);?></p>
                    <span><?php echo str_cut(strip_tags($r[description]),130);?></span>
                </a></li>
                <?php $n++;}unset($n); ?>
                </ul>   
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <div class="pages"><?php echo $pages;?></div>
        </div>
    </div>
</section>
<?php include template("content","footer"); ?>