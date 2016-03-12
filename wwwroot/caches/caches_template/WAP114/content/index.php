<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<section>
    <div class="region">
        <h2>团队动态</h2>
        <div class="img_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6c70c0e1956f81426a1fa50f7d4cc5c9&action=lists&catid=18&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'18','order'=>'listorder DESC','limit'=>'4',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="img_list clearfix"><a href="<?php echo $dv['url'];?>">
                <img src="<?php echo $dv['thumb'];?>" onload="autoimg()" class="imgauto"/>
                <p><?php echo str_cut($dv['title'],43);?></p>
                <span><?php echo str_cut(strip_tags($dv[description]),90);?></span>
            </a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=18">进入团队动态栏目</a></div>
    </div>
    <div class="region">
        <h2>热点关注</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a1056afe394cf3491781d5eb03f43a78&action=lists&catid=24&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'24','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=24">进入热点关注栏目</a></div>
    </div>
    <div class="region" id="picScroll">
        <h2>律师团队</h2>
        <div class="lawer_imgs bd">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6f4c573727185c283fc095fc250c83ae&action=lists&catid=56&thumb=1&num=16&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'56','thumb'=>'1','order'=>'listorder DESC','limit'=>'16',));}?>
            <?php $i=1;?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <?php if($i<=8) { ?>
            <li class="lawer_img"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" onload="autoimg()" class="imgauto2"/><p><?php echo $dv['title'];?></p></a></li>
            <?php } elseif ($i==9) { ?>
            </ul>
            <ul>
            <li class="lawer_img"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" onload="autoimg()" class="imgauto2"/><p><?php echo $dv['title'];?></p></a></li>
            <?php } elseif ($i>9) { ?>
            <li class="lawer_img"><a href="<?php echo $dv['url'];?>"><img src="<?php echo $dv['thumb'];?>" onload="autoimg()" class="imgauto2"/><p><?php echo $dv['title'];?></p></a></li>
            <?php } ?>
            <?php $i++;?>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="hd"><ul></ul></div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=56">进入律师团队栏目</a></div>
    </div>
    <script type="text/javascript">
        TouchSlide({ 
            slideCell:"#picScroll",
            titCell:".hd ul",
            autoPage:"true", 
            pnLoop:"false"
        });
    </script>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show01.jpg" />
    <div class="region">
        <h2>法律论坛</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=64f47625bcccfe002a4eb6a7ea64d88f&action=lists&catid=25&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'25','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=25">进入法律论坛栏目</a></div>
    </div>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show02.jpg" />
    <div class="region">
        <h2>精选案例</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cb0353fa4866e64aa4c6543eaab66fe2&action=lists&catid=8&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'8','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=8">进入精选案例栏目</a></div>
    </div>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show03.jpg" />
    <div class="region">
        <h2>合同范本</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3702cad4c79d90b3025367ed4fcbed94&action=lists&catid=28&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'28','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=28">进入合同范本栏目</a></div>
    </div>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show04.jpg" />
    <div class="region">
        <h2>房地产</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=51d044b0cf1c7eb4340a02511fc56a41&action=lists&catid=29&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'29','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=29">进入房地产栏目</a></div>
    </div>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show05.jpg" />
    <div class="region">
        <h2>建设工程</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ce9d52bff1ac292e891ad6a675af7b51&action=lists&catid=38&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'38','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=38">进入建设工程栏目</a></div>
    </div>
    <img class="index_show" src="<?php echo SKIN_PATH;?>images/show06.jpg" />
    <div class="region">
        <h2>合同商事</h2>
        <div class="news_lists">
            <ul>
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=222816b2bb004e4162b0ac4c8a34e6c9&action=lists&catid=39&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'39','order'=>'listorder DESC','limit'=>'8',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $dv) { ?>
            <li class="news_list"><a href="<?php echo $dv['url'];?>"><?php echo str_cut($dv['title'],43);?><span><?php echo date('Y-m-d',$dv['inputtime']);?></span></a></li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
        </div>
        <div class="more"><a href="/index.php?m=content&c=index&a=lists&catid=39">进入合同商事栏目</a></div>
    </div>
</section>
<?php include template("content","footer"); ?>