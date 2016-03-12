<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=B605c6b7d306d1119709ab461bac0fa3"></script>
<!--<script type="text/javascript" src="<?php echo JS_PATH?>mobile/bd_map.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH?>mobile/baiduMap.js"></script>-->
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"<?php echo L("input").L('site_name')?>",onfocus:"<?php echo L("input").L('site_name')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('site_name')?>"}).ajaxValidator({type : "get",url : "",data :"m=admin&c=site&a=public_name&siteid=<?php echo $data['siteid']?>",datatype : "html",async:'true',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "<?php echo L('site_name').L('exists')?>",onwait : "<?php echo L('connecting')?>"}).defaultPassed();
		$("#dirname").formValidator({onshow:"<?php echo L("input").L('site_dirname')?>",onfocus:"<?php echo L("input").L('site_dirname')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('site_dirname')?>"}).regexValidator({regexp:"username",datatype:"enum",param:'i',onerror:"<?php echo L('site_dirname_err_msg')?>"}).ajaxValidator({type : "get",url : "",data :"m=admin&c=site&a=public_dirname&siteid=<?php echo $data['siteid']?>",datatype : "html",async:'false',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "<?php echo L('site_dirname').L('exists')?>",onwait : "<?php echo L('connecting')?>"}).defaultPassed();
		$("#domain").formValidator({onshow:"<?php echo L('site_domain_ex')?>",onfocus:"<?php echo L('site_domain_ex')?>",tipcss:{width:'300px'},empty:false}).inputValidator({onerror:"<?php echo L('site_domain_ex')?>"}).regexValidator({regexp:"http:\/\/(.+)\/$",onerror:"<?php echo L('site_domain_ex2')?>"});
		$("#template").formValidator({onshow:"<?php echo L('style_name_point')?>",onfocus:"<?php echo L('select_at_least_1')?>"}).inputValidator({min:1,onerror:"<?php echo L('select_at_least_1')?>"});
		$('#release_point').formValidator({onshow:"<?php echo L('publishing_sites_to_other_servers')?>",onfocus:"<?php echo L('choose_release_point')?>"}).inputValidator({max:4,onerror:"<?php echo L('most_choose_four')?>"});
		$('#default_style_input').formValidator({tipid:"default_style_msg",onshow:"<?php echo L('please_select_a_style_and_select_the_template')?>",onfocus:"<?php echo L('please_select_a_style_and_select_the_template')?>"}).inputValidator({min:1,onerror:"<?php echo L('please_choose_the_default_style')?>"});
	})
//-->
</script>
<style type="text/css">
.radio-label{ border-top:1px solid #e4e2e2; border-left:1px solid #e4e2e2}
.radio-label td{ border-right:1px solid #e4e2e2; border-bottom:1px solid #e4e2e2;background:#f6f9fd}
</style>
<div class="pad-10">
<form action="?m=admin&c=site&a=edit&siteid=<?php echo $siteid?>" method="post" id="myform">
<fieldset>
	<legend><?php echo L('basic_configuration')?></legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80"><?php echo L('site_name')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="<?php echo $data['name']?>" /></td>
  </tr>
  <tr>
    <th><?php echo L('site_dirname')?>：</th>
    <td class="y-bg"><?php if ($siteid == 1) { echo $data['dirname'];} else {?><input type="text" class="input-text" name="dirname" id="dirname" size="30" value="<?php echo $data['dirname']?>" /><?php }?></td>
  </tr>
    <tr>
    <th><?php echo L('site_domain')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain"  size="30" value="<?php echo $data['domain']?>" /></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend><?php echo L('contact_method')?></legend>
	<table width="100%"  class="table_form">
    <!--<tr>
      <th width="80"><?php echo L('contact_phone_no')?>：</th>
      <td class="y-bg"><input onkeyup="value=value.replace(/[^\d]/ig,'')" type="text" class="input-text" name="phone_no" id="phone_no" size="30" value="<?php echo $data['phone_no']?>" /></td>
    </tr>
    <tr>
      <th><?php echo L('contact_msg_no')?>：</th>
      <td class="y-bg"><input onkeyup="value=value.replace(/[^\d]/ig,'')" type="text" class="input-text" name="msg_no" id="msg_no" size="30" value="<?php echo $data['msg_no']?>" /></td>
    </tr>
      <tr>
      <th><?php echo L('contact_zixun')?>：</th>
      <td class="y-bg"><input type="text" class="input-text" name="zixun_url" id="zixun_url"  size="30" value="<?php echo $data['zixun_url']?>" /></td>
    </tr>-->
    <tr>
    <th><?php echo L('map_address')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="map_info[address]" id="address"  size="30" value="<?php echo $map_info['address']?>" /> <input type="button" value="查找" onclick="searchMap()" /> <span style="color:#666">若无法定位，请尝试手动拖拽定位</span></td>
  </tr>
  </tr>
    <tr>
    <th><?php echo L('map_address_tag')?>：</th>
    <td class="y-bg">
    <input type="text" class="input-text" name="map_info[address_tag]" id="address_tag"  size="30" value="<?php echo $map_info['address_tag']?>" />
	<input type="hidden" value="<?php echo $map_info['center_map']?>" name="map_info[center_map]" id="center_map" />
	<input type="hidden" value="<?php echo $map_info['mark_map']?>" name="map_info[mark_map]" id="mark_map" />
	<input type="hidden" value="<?php echo $map_info['zoom']?>" name="map_info[zoom]" id="zoom" />
	<input type="hidden" value="<?php echo $map_info['static_map']?>" name="map_info[static_map]" id="static_map" />
    </td>
  </tr>
  <tr>
    <td colspan="2">
        <p style="padding:5px 0">
        <span style="color:#666">鼠标左键双击放大，右键双击缩小</span>
        <input type="checkbox" id="wheelZoom" value="1" /> <label for="wheelZoom">鼠标滚轮缩放</label>
        </p>
        <div id="mapcontainer" style="width: 630px; height: 400px; float: left; background: url(/image/ajax-loader.gif) center no-repeat;"></div>
        <div class="bk"></div>
        <div style="background:#EAF8FD; border:1px dashed #A9E3FA; margin-top:10px; padding:5px">
        静态地图调用方式：<?php echo htmlspecialchars('<img src="'.urldecode($map_info['static_map']).'" alt="'.$map_info['address_tag'].'"/>')?>
        </div>
        <div style="background:#EAF8FD; border:1px dashed #A9E3FA; margin-top:10px; padding:5px">
        动态地图调用方式：<?php echo htmlspecialchars('<iframe width="100%" src="/index.php?a=map" height="512" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0"></iframe>')?>
        </div>
        <div style="border:1px dashed #F90; background:#FBF7EA; margin-top:10px; padding:5px">注：选择需要展示方式复制代码在编辑器代码模式下的适当位置粘贴即可</div>
    </td>
  </tr>
</table>
</fieldset>
<!--pw 2014/1/17-->
<div class="bk10"></div>
<fieldset>
	<legend>QQ在线客服</legend>
    <div style="border:1px dashed #F90; background:#FBF7EA; margin-top:10px; padding:5px">
	调用方式：在页面适当位置插入<?php echo htmlspecialchars('<script language="javascript" src="/index.php?c=kefu&a=qqkefu&q=imkv&rand={mt_rand()}"></script>')?>
	</div>
	<table width="100%"  class="table_form">
    <tr>
    	<td width="80">客服开关：</td>
        <td>
        	<input <?php if($kefu_conf['kefu_switch']=='1')echo 'checked'?> type="radio" name="kefu_conf[kefu_switch]" id="kefu_switch1" value="1" /> <label for="kefu_switch1">启用</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_switch']=='0')echo 'checked'?> type="radio" name="kefu_conf[kefu_switch]" id="kefu_switch0" value="0" /> <label for="kefu_switch0">关闭</label>&nbsp;&nbsp;
        </td>
    </tr>
	<tr>
        <th>QQ号码：</th>
        <td class="y-bg">
        	<textarea name="kefu_conf[qq_no]" id="qq_no" rows="5" style="resize:none; width:60%"><?php echo $kefu_conf['qq_no']?></textarea>
            <br />
            请按该格式添加：QQ号码|名字/昵称，一行一个
        </td>
	</tr>
	<tr>
        <th>风格：</th>
        <td class="y-bg">
        	<input <?php if($kefu_conf['kefu_style']=='style1')echo 'checked'?> type="radio" name="kefu_conf[kefu_style]" id="style1" value="style1" /> <label for="style1">风格一</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_style']=='style2')echo 'checked'?> type="radio" name="kefu_conf[kefu_style]" id="style2" value="style2" /> <label for="style2">风格二</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_style']=='style3')echo 'checked'?> type="radio" name="kefu_conf[kefu_style]" id="style3" value="style3" /> <label for="style3">风格三</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_style']=='kefu_customer')echo 'checked'?> type="radio" name="kefu_conf[kefu_style]" id="kefu_customer"  value="kefu_customer" /> <label for="kefu_customer">自定义</label>
			<div style="background:#EAF8FD; border:1px dashed #A9E3FA; margin-top:10px; padding:5px">
            关于自定义：请修改skin/当前模板目录/css/kefu/kefu_customer/style.css，自定义图片存放在修改skin/当前模板目录/images/kefu/kefu_customer/下，js效果将沿用系统效果
            </div>
            
            <div style="margin-top:10px"><img id="style_preview" src="<?php echo SKIN_PATH.'images/kefu/customer/preview.jpg'?>" /></div>
        </td>
    </tr>
    <tr>
    	<th>展示位置：</th>
        <td>
        	<input <?php if($kefu_conf['kefu_pos']=='right')echo 'checked'?> type="radio" name="kefu_conf[kefu_pos]" value="right" id="pos_right"  /> <label for="pos_right">右侧</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_pos']=='left' )echo 'checked'?> type="radio" name="kefu_conf[kefu_pos]" value="left" id="pos_left"  /> <label for="pos_left">左侧</label>
        </td>
    </tr>
    <tr>
    	<th>展示方式：</th>
        <td>
        	<input <?php if($kefu_conf['kefu_show_way']=='hover')echo 'checked'?> type="radio" name="kefu_conf[kefu_show_way]" value="hover" id="hover"  /> <label for="hover">鼠标经过展示</label>&nbsp;&nbsp;
        	<input <?php if($kefu_conf['kefu_show_way']=='always' )echo 'checked'?> type="radio" name="kefu_conf[kefu_show_way]" value="always" id="always"  /> <label for="always">始终展示</label>
        </td>
    </tr>
    <tr>
    	<th>距离顶部：</th>
        <td><input type="text" class="input-text" name="kefu_conf[top_away]" id="top_away"  size="30" value="<?php echo $kefu_conf['top_away']?>" /> 像素，请填写数字</td>
    </tr>
    <tr>
    	<th>联系方式：</th>
        <td><input type="text" class="input-text" name="kefu_conf[tel_no]" id="tel_no"  size="50" value="<?php echo $kefu_conf['tel_no']?>" /> 多个请用|隔开，如000-00000000|1355xxxxxxx</td>
    </tr>    
	<tr>        
        <th>手机版：</th>
        <td class="y-bg">
            <input type="text" class="input-text" name="kefu_conf[td_code]" id="td_code"  size="50" value="<?php echo $kefu_conf['td_code']?>" /> 用于生成二维码，格式为标准的URL，请以"http://"开头，如：http://www.cdbaidu.com
        </td>
	</tr>
</table>
</fieldset>


<div class="bk10"></div>
<fieldset>
	<legend><?php echo L('seo_configuration')?></legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80"><?php echo L('site_title')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="site_title" id="site_title" size="30" value="<?php echo $data['site_title']?>" /></td>
  </tr>
  <tr>
    <th><?php echo L('keyword_name')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="keywords" id="keywords" size="30" value="<?php echo $data['keywords']?>" /></td>
  </tr>
    <tr>
    <th><?php echo L('description')?>：</th>
    <td class="y-bg"><input type="text" class="input-text" name="description" id="description" size="30" value="<?php echo $data['description']?>" /></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend><?php echo L('release_point_configuration')?></legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80" valign="top"><?php echo L('release_point')?>：</th>
    <td> <select name="release_point[]" size="3" id="release_point" multiple title="<?php echo L('ctrl_more_selected')?>">
    <option value='' <?php if(!$data['release_point']) echo 'selected';?>><?php echo L('not_use_the_publishers_some')?></option>
		  <?php if(is_array($release_point_list) && !empty($release_point_list)): foreach($release_point_list as $v):?>
		  <option value="<?php echo $v['id']?>"<?php if(in_array($v['id'], explode(',',$data['release_point']))){echo ' selected';}?>><?php echo $v['name']?></option>
	<?php endforeach;endif;?>
		</select></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend><?php echo L('template_style_configuration')?></legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80" valign="top"><?php echo L('style_name')?>：</th>
    <?php
    //pw 2013/7/5修改，只能选择一种风格，同时自动应用到栏目
	?>
    <td class="y-bg"> <select name="template[]" size="3" id="template" title="<?php echo L('ctrl_more_selected')?>" onchange="default_list()">
    
    	<?php 
	    	$default_template_list =  array();
	    	if (isset($data['template'])) {
	    		$dirname = explode(',',$data['template']);
	    	} else {
	    		$dirname = array();
	    	}
	    	if(is_array($template_list)):
    		foreach ($template_list as $key=>$val):
    		$default_template_list[$val['dirname']] = $val['name'];
    	?>
		  <option value="<?php echo $val['dirname']?>" <?php if(in_array($val['dirname'], $dirname)){echo 'selected';}?>><?php echo $val['name']?></option>
		  <?php endforeach;endif;?>
		</select></td>
  </tr>
  <tr style="display:none">
    <th width="80" valign="top"><?php echo L('default_style')?>：<input type="hidden" name="default_style" id="default_style_input" value="<?php echo $data['default_style']?>"></th>
    <td class="y-bg"><span id="default_style">
	<?php 
		if(is_array($dirname) && !empty($dirname)) foreach ($dirname as $v) {
			echo '<label><input type="radio" name="default_style_radio" value="'.$v.'" onclick="$(\'#default_style_input\').val(this.value);" '.($data['default_style']==$v ? 'checked' : '').'>'.$default_template_list[$v].'</label>';
		}
	?>
	</span><span id="default_style_msg"></span></td>
  </tr>
</table>
<script type="text/javascript">
function default_list() {
	var template=document.getElementById('template'),templateOpt=template.options[template.selectedIndex];
	var html = '';
	var old = $('#default_style_input').val();
	var checked = '';
	
	html = '<label><input type="radio" name="default_style_radio" value="'+templateOpt.value+'" onclick="$(\'#default_style_input\').val(this.value);" checked> '+templateOpt.text+'</label>';
	
//	$('#template option:selected').each(function(i,n){
//		if (old == $(n).val()) {
//			checked = 'checked';
//		}
//		 html += '<label><input type="radio" name="default_style_radio" value="'+$(n).val()+'" onclick="$(\'#default_style_input\').val(this.value);" '+checked+'> '+$(n).text()+'</label>';
//	});
//	if(!checked)  $('#default_style_input').val('0');
	
	$('#default_style').html(html);
	$('#default_style_input').val(templateOpt.value);
}
</script>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend><?php echo L('site_att_config')?></legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="130" valign="top"><?php echo L('site_att_upload_maxsize')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[upload_maxsize]" id="upload_maxsize" size="10" value="<?php echo $setting['upload_maxsize'] ? $setting['upload_maxsize'] : '2000' ?>"/> KB </td>
  </tr>
  <tr>
    <th width="130" valign="top"><?php echo L('site_att_allow_ext')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[upload_allowext]" id="upload_allowext" size="50" value="<?php echo $setting['upload_allowext']?>"/></td>
  </tr>  
    <tr>
    <th><?php echo L('site_att_gb_check')?></th>
    <td class="y-bg"><?php echo $this->check_gd()?></td>
  <tr>
    <th><?php echo L('site_att_watermark_enable')?></th>
    <td class="y-bg">
	  <input class="radio_style" name="setting[watermark_enable]" value="1" <?php echo $setting['watermark_enable']==1 ? 'checked="checked"' : ''?> type="radio"> <?php echo L('site_att_watermark_open')?>&nbsp;&nbsp;&nbsp;&nbsp;
	  <input class="radio_style" name="setting[watermark_enable]" value="0" <?php echo $setting['watermark_enable']==0 ? 'checked="checked"' : ''?> type="radio"> <?php echo L('site_att_watermark_close')?>
     </td>
  </tr>    
  <tr>
    <th><?php echo L('site_att_watermark_condition')?></th>
    <td class="y-bg"><?php echo L('site_att_watermark_minwidth')?>
<input type="text" class="input-text" name="setting[watermark_minwidth]" id="watermark_minwidth" size="10" value="<?php echo $setting['watermark_minwidth'] ? $setting['watermark_minwidth'] : '300' ?>" /> X <?php echo L('site_att_watermark_minheight')?><input type="text" class="input-text" name="setting[watermark_minheight]" id="watermark_minheight" size="10" value="<?php echo $setting['watermark_minheight'] ? $setting['watermark_minheight'] : '300' ?>" /> PX
     </td>
  </tr>
  <tr>
    <th width="130" valign="top"><?php echo L('site_att_watermark_img')?></th>
    <td class="y-bg"><input type="text" name="setting[watermark_img]" id="watermark_img" size="30" value="<?php echo $setting['watermark_img'] ? $setting['watermark_img'] : 'mark.gif' ?>"/><?php echo L('site_att_watermark_img_desc')?></td>
  </tr> 
   <tr>
    <th width="130" valign="top"><?php echo L('site_att_watermark_pct')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[watermark_pct]" id="watermark_pct" size="10" value="<?php echo $setting['watermark_pct'] ? $setting['watermark_pct'] : '100' ?>" />  <?php echo L('site_att_watermark_pct_desc')?></td>
  </tr> 
   <tr>
    <th width="130" valign="top"><?php echo L('site_att_watermark_quality')?></th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[watermark_quality]" id="watermark_quality" size="10" value="<?php echo $setting['watermark_quality'] ? $setting['watermark_quality'] : '80' ?>" /> <?php echo L('site_att_watermark_quality_desc')?></td>
  </tr> 
   <tr>
    <th width="130" valign="top"><?php echo L('site_att_watermark_pos')?></th>
    <td>
    <table width="100%" class="radio-label">
  <tr>
  <td rowspan="3"><input class="radio_style" name="setting[watermark_pos]" value="10" type="radio" <?php echo ($setting['watermark_pos']==10) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_10')?></td>
    <td><input class="radio_style" name="setting[watermark_pos]" value="1" type="radio" <?php echo ($setting['watermark_pos']==1) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_1')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="2" type="radio" <?php echo ($setting['watermark_pos']==2) ? 'checked':'' ?>> <?php echo L('site_att_watermark_pos_2')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="3" type="radio" <?php echo ($setting['watermark_pos']==3) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_3')?></td>
  </tr>
  <tr>
    <td><input class="radio_style" name="setting[watermark_pos]" value="4" type="radio" <?php echo ($setting['watermark_pos']==4) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_4')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="5" type="radio" <?php echo ($setting['watermark_pos']==5) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_5')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="6" type="radio" <?php echo ($setting['watermark_pos']==6) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_6')?></td>
    </tr>
  <tr>
    <td><input class="radio_style" name="setting[watermark_pos]" value="7" type="radio" <?php echo ($setting['watermark_pos']==7) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_7')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="8" type="radio" <?php echo ($setting['watermark_pos']==8) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_8')?></td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="9" type="radio" <?php echo ($setting['watermark_pos']==9) ? 'checked':''?>> <?php echo L('site_att_watermark_pos_9')?></td>
    </tr>
</table>
      </td></tr>
</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="<?php echo L('submit')?>" />
</div>
</form>
</div>
    <script type="text/javascript">
	
		var map = new BMap.Map("mapcontainer");
		var point = new BMap.Point(<?php echo $mark_map[0]?$mark_map[0]:104.080659?>, <?php echo $mark_map[1]?$mark_map[1]:30.619662?>);
		map.centerAndZoom(point, <?php echo $map_info['zoom']?$map_info['zoom']:16?>);

		map.addControl(new BMap.NavigationControl());
		var marker = new BMap.Marker(point);  
		map.addOverlay(marker);
		//marker.setAnimation(BMAP_ANIMATION_BOUNCE); 
		marker.enableDragging();
		
		//创建信息窗口
		var infoWindow1 = new BMap.InfoWindow("<?php echo $map_info['address_tag']?>");
		infoWindow1.enableCloseOnClick();
		marker.openInfoWindow(infoWindow1);
		marker.addEventListener("click", function(){this.openInfoWindow(infoWindow1);});		

		
		marker.addEventListener("dragend", function(e){  
			var cp=map.getCenter(),point2=new BMap.Point(e.point.lng,e.point.lat);
			map.centerAndZoom(point2, map.getZoom());
			infoWindow1.disableAutoPan();
			$('#center_map').val(cp.lng+","+cp.lat);
			$('#mark_map').val(e.point.lng+","+e.point.lat);
			$('#static_map').val((getStaticMap()));
		}) 
		map.addEventListener("dragend", function(e){  
			infoWindow1.disableAutoPan();
		});
		map.addEventListener("zoomend",function(e){
			$('#zoom').val(map.getZoom());
		});
		$('#wheelZoom').click(function(){map[this.checked?"enableScrollWheelZoom":"disableScrollWheelZoom"]();});
		$(':radio[name=\'kefu_conf[kefu_style]\']').bind("click",function(){
			$("#style_preview").attr("src","<?php echo SKIN_PATH?>images/kefu/"+this.value+"/preview.jpg");	
		});$(':radio[name=\'kefu_conf[kefu_style]\']:checked').click();
		
		function searchMap(){
			var address=$("#address").val();
		 	if(!address)return;
			var myGeo = new BMap.Geocoder();
			// 将地址解析结果显示在地图上,并调整地图视野
			myGeo.getPoint(address, function(point){
				if (point) {
					var cp=map.getCenter();
					map.centerAndZoom(point,map.getZoom());
					marker.setPosition(point);
					$('#center_map').val(cp.lng+","+cp.lat);
					$('#mark_map').val(point.lng+","+point.lat);
					$('#static_map').val(encodeURIComponent(getStaticMap()));
				}
			});	
		}
		function getStaticMap() {
			if (map == '' || map == 'undefined' || marker == '') {
				return;
			}
			var center = map.getCenter().lng + ',' + map.getCenter().lat;
			var markers = marker.getPosition().lng + ',' + marker.getPosition().lat;
			var zoom = map.getZoom();
			var staticmapstr = 'http://api.map.baidu.com/staticimage?center=' + center + '&markers=' + markers + '&zoom=' + zoom;
			return staticmapstr;
		}
		
    </script>
</body>
</html>