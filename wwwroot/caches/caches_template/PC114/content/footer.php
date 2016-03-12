<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>    </div>
    <div id="footer">
        <div class="friendlink">
            <div class="main">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c45a92fa5cf221c5e9c20a535b3badf4&action=getRecord&name=news+as+news2+&join=+left+join+news_data+as+news1+on+news1.id%3Dnews2.id&fields=content&where=+title+eq+%27%E5%8F%8B%E6%83%85%E9%93%BE%E6%8E%A5%27&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getRecord')) {$data = $content_tag->getRecord(array('name'=>'news as news2 ','join'=>' left join news_data as news1 on news1.id=news2.id','fields'=>'content','where'=>' title eq \'友情链接\'','limit'=>'1',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <p><?php echo $r['content'];?></p>
            <?php $n++;}unset($n); ?>
            </div>
        </div>
        <div class="copyright">
            <div class="main">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1b63a6383958c804ce51573bb64baa24&action=getRecord&name=news+as+news2+&join=+left+join+news_data+as+news1+on+news1.id%3Dnews2.id&fields=content&where=+title+eq+%27PC%E7%89%88%E6%9D%83%E4%BF%A1%E6%81%AF%27&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'getRecord')) {$data = $content_tag->getRecord(array('name'=>'news as news2 ','join'=>' left join news_data as news1 on news1.id=news2.id','fields'=>'content','where'=>' title eq \'PC版权信息\'','limit'=>'1',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <p><?php echo $r['content'];?></p>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
        </div>
    </div>
</body>
</html>