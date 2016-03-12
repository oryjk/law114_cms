<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=1bc12def622d7fc5b1f32263d7e01cbe&action=category&catid=%24catid&num=1&order=listorder+ASC&return=data\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>$catid,'order'=>'listorder ASC','limit'=>'1',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<script language="javascript" type="text/javascript">
window.location.href="index.php?m=content&c=index&a=lists&catid=<?php echo $r['catid'];?>";
</script>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>