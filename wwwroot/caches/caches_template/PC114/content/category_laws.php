<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header_c"); ?>
    <div class="content clearfix">
        <div class="list_left">
            <div class="list_title">
                <h3><?php echo $CATEGORYS[$catid]['catname'];?></h3>
                <span><a href="/">首页 </a><?php echo catpos($catid,'>');?></span>
            </div>
            <div class="all_list clearfix">
            <div class="item_laws_hd clearfix"><h3>法规名称</h3><p>文号</p><span>颁布时间</span></div>
            		<?php $key=$_GET[q]?>
                    <?php if($key) { ?>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f9d7ee83cca22123888c9335073dcf7b&action=lists&catid=%24catid&where=title+like+%27%25%24key%25%27&order=listorder+ASC%2Cinputtime+desc%2Cid+desc&num=15&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'where'=>"title like '%$key%'",'order'=>'listorder ASC,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'where'=>"title like '%$key%'",'order'=>'listorder ASC,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                    <?php } else { ?>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9f4843a169ee24356b72d5e70d9b2046&action=lists&catid=%24catid&order=listorder+ASC%2Cinputtime+desc%2Cid+desc&num=15&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 15;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder ASC,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder ASC,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                    <?php } ?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <div class="item_laws clearfix"><a href="<?php echo $r['url'];?>">
                <h3><?php echo str_cut($r['title'],70);?></h3>
                <p><?php echo str_cut($r['lawno'],40);?></p>
                <span><?php echo date('Y-m-d',$r['inputtime']);?></span>
            </a></div>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <div class="pages lawspage"><?php echo $pages;?></div>
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
                <div class="right_title">民商管理数据库</div>
                <ul class="right_cat">
				<?php $n=1;if(is_array(subcat($catid))) foreach(subcat($catid) AS $c) { ?>
                	<li><a href="<?php echo $c['url'];?>"><?php echo $c['catname'];?>(<span style="color:red"><?php echo $c['items'];?></span>件)</a></li>
                <?php $n++;}unset($n); ?>
                </ul>
            </div>
            <div class="weixin">
            <img src="<?php echo $CATEGORYS['97']['image'];?>" />
            </div>
            <div class="show_right3">
                <div class="right_title">最新法规</div>
                <div class="right3_list">
                    <ul>
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0690b20f3e78f88fdc6f12e4aa8d9214&action=lists&catid=73&order=listorder+ASC%2Cinputtime+desc%2Cid+desc&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'73','order'=>'listorder ASC,inputtime desc,id desc','limit'=>'10',));}?>
                    <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
                    <li><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],47);?></a></li>
                    <?php $n++;}unset($n); ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php include template("content","footer"); ?>