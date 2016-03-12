<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>var str = "";
<?php $n=1; if(is_array($pinfo)) foreach($pinfo AS $k => $p) { ?>
<?php if($k==0) { ?>
str += "<?php echo $p['setting']['1']['imageurl'];?>"
<?php } else { ?>
str += "|<?php echo $p['setting']['1']['imageurl'];?>"
<?php } ?>
<?php $n++;}unset($n); ?>
	var focus_width=<?php echo $width;?>;
	var focus_height=<?php echo $height;?>;
	var text_height=0;
	var swf_height = focus_height+text_height
	
	
	var pics=str;
	var links='';
	var texts='';
	document.write('<object ID="focus_flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
	document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="<?php echo SKIN_PATH;?>images/pixviewer.swf"><param name="quality" value="high"><param name="bgcolor" value="#ffffff">');
	document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
	document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
	document.write('<embed ID="focus_flash" src="<?php echo SKIN_PATH;?>images/pixviewer.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#ffffff" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');		
	document.write('</object>');