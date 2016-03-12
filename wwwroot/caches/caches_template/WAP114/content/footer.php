<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><footer>
    <div class="gotop"><a href="#header">回顶部↑</a></div>
    <div class="info">
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=04bd887747ef75ffb841ac0aff395b64&action=getRecord&name=news+as+news2+&join=+left+join+news_data+as+news1+on+news1.id%3Dnews2.id&fields=content&where=+title+eq+%27%E7%89%88%E6%9D%83%E4%BF%A1%E6%81%AF%27&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getRecord')) {$data = $content_tag->getRecord(array('name'=>'news as news2 ','join'=>' left join news_data as news1 on news1.id=news2.id','fields'=>'content','where'=>' title eq \'版权信息\'','limit'=>'1',));}?>
        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        <p><?php echo $r['content'];?></p>
        <?php $n++;}unset($n); ?>
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
</footer>
<div id="Quicks">
    <ul class="quick clearfix">
    <?php $siteinfo=siteinfo(SITEID?1:SITEID)?>
        <li><a href="/index.php?a=map"><img src="<?php echo SKIN_PATH;?>images/btn1.png" /></a></li>
        <li><a href="mailto:service028164@gmail.com"><img src="<?php echo SKIN_PATH;?>images/btn2.png" /></a></li>
        <li><a href="#"><img src="<?php echo SKIN_PATH;?>images/btn3.png" /></a></li>
    </ul>
</div>
</body>
</html>