<?php
header("Content-Type: text/html;charset=utf-8");

require("config.php");

$style = $_GET["style"];

$id = getIdByStyleName($style,$Mystyle);

If ($id>-1){
	echo updatejs($Mystyle[$id]);
}else{
	echo "<script language=\"javascript\" type=\"text/javascript\">alert('The style not exists');</script>";
}


function getIdByStyleName($n,$arry){

	for ($i=0;$i<count($arry);$i++){
		$v = $arry[$i][0][0];
		if (strtolower($n) == strtolower($v)){
			return $i;
		}
	}
	return -1;
}



//生成JS脚本字符串;
function updatejs($arry){

    $js_name = jsparam();
	$js_intro = jsintro();

	$temp_str = "";

	for ($i=0;$i<count($arry[0]);$i++){
        $temp_str .= $js_name[$i] . " = \"" . $arry[0][$i] . "\";  //" . Addsomestr($js_name[$i].$arry[0][$i],"-") . "(" . $i . ")" . $js_intro[$i] . "ΔΔΔ" . "\n\r";
	}

	$temp_str .= "config.ToolBarName = [";
	for($i=0;$i<count($arry[1]);$i++){
        If ($i==0){ 
		    $temp_str .= "\"" . $arry[1][$i][0] . "\"";
		}else{
		    $temp_str .= ",\"" . $arry[1][$i][0] . "\"";
		}
	}
	$temp_str .= "];" . "\n\r";

	$temp_str .= "config.Toolbars = [" . "\n\r";
	for ($i=0;$i<count($arry[1]);$i++){
	    $temp_str .= "[";
		$mybt = explode(",",$arry[1][$i][1]);
		$umybt = count($mybt);
		for ($j=0;$j<$umybt;$j++){
			If ($j==0){
				$temp_str .= "\"" . $mybt[$j] . "\"";
			}else{
				$temp_str .= ",\"" . $mybt[$j] . "\"";
			}
		}
	    If ($i==count($arry[1])-1){ 
	        $temp_str .= "]" . "\n\r";
		}else{
		    $temp_str .= "]," . "\n\r";
		} 
	}
	$temp_str .= "];";

	return $temp_str;
}

function jsparam(){
    return Array("config.styleName","config.IntroWidth","config.IntroHeight","config.Intro","config.InitMode","config.FixWidth","config.Skin","config.StateFlag","config.SBCode","config.SBEdit","config.SBText","config.SBView","config.AutoDetectPasteFromWord","config.AutoRemote","config.ShowBorder","config.AutoDetectLanguage","config.DefaultLanguage","config.EnterMode","config.AreaCssMode","config.ServerExt","config.UploadObject","config.AutoDir","config.AllowBrowse","config.CusDirFlag","config.BaseUrl","config.UploadUrl","config.BaseHref","config.ContentPath","config.AllowImageExt","config.AllowFlashExt","config.AllowMediaExt","config.AllowFileExt","config.AllowRemoteExt","config.AllowLocalExt","config.AllowImageSize","config.AllowFlashSize","config.AllowMediaSize","config.AllowFileSize","config.AllowRemoteSize","config.AllowLocalSize","config.sltsyObject","config.sltsyExt","config.sltFlag","config.sltMinsize","config.sltOksize","config.SYWZFlag","config.sywzminWidth","config.sywzminHeight","config.syText","config.syFontColor","config.syShadowColor","config.syShadowOffset","config.syFontSize","config.syFontName","config.sywzPosition","config.sywzPaddingH","config.sywzPaddingV","config.sywzTextWidth","config.sywzTextHeight","config.SYTPFlag","config.sytpminWidth","config.sytpminHeight","config.sytpPosition","config.sytpPaddingH","config.sytpPaddingV","config.syPicPath","config.sytPopacity","config.sytpImageWidth","config.sytpImageHeight");
}

function jsintro(){
	return Array("样式名称","最佳宽度","最佳高度","备注说明","初始模式","限宽模式宽度","界面皮肤目录","显示状态栏及按钮：状态栏","显示状态栏及按钮：代码","显示状态栏及按钮：编辑","显示状态栏及按钮：文本","显示状态栏及按钮：预览","Word粘贴","远程文件","指导方针","自动语言检测","默认语言","回车换行模式","编辑区CSS模式","上传脚本","上传组件","年月日自动目录","上传文件浏览","自定上传路径接口","路径模式","上传路径","显示路径","内容路径","图片类型","Flash类型","媒体类型","附件类型","远程类型","本地类型","图片限制","Flash限制","媒体限制","附件限制","远程限制","本地限制","图形处理组件","处理图形扩展名","缩略图使用状态","缩略图长度条件","缩略图生成长度","文字水印使用状态","文字水印启用条件：宽","文字水印启用条件：高:","文字水印内容","文字水印字体颜色","文字水印阴影颜色","文字水印阴影大小","文字水印字体大小","文字水印字体名称","文字水印位置","文字水印边距：左右","文字水印边距：上下","文字水印文字占位：宽","文字水印文字占位：高","图片水印使用状态","图片水印启用条件：宽:px","图片水印启用条件：高:px","图片水印位置","图片水印边距： 左右:px","图片水印边距：上下:px","图片水印图片路径","图片水印透明度","图片水印图片占位：宽:px","图片水印图片占位：高:px");
}

//生成指定数目的重复字符串;
function Addsomestr($s,$str){
	$temp_str = "";
    for ($i=strlen($s);$i<=80;$i++){
        $temp_str .= $str;
    }
	return " " . $temp_str . " ";
}

?>