<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<section>
    <div class="region">
        <h2><?php echo $CATEGORYS[$catid]['catname'];?></h2>
        <div class="show_title"><?php echo $title;?></div>
        <div class="show_info">四川民商律师网&nbsp;&nbsp;&nbsp;<?php echo $inputtime;?></div>
        <div class="show_content "><?php echo $content;?></div>
    </div>
</section>  
<?php include template("content","footer"); ?>