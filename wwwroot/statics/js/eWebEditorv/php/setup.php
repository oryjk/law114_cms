<?php
header("Content-Type: text/html;charset=utf-8");

//================参数设置s============================================================================
$uid = "admin";
$pwd = "xxlplqyu89";
$EditorBasePath = "../"; //编辑器所在目录
$PHPConfigPath = "config.php"; //配置文件相对路径; 须与下面的require保持一置

require("config.php");
//================参数设置e============================================================================


$action = strtolower(TrimRq("action"));
$id     = strtolower(TrimRq("id"));
$tid    = strtolower(TrimRq("tid"));

if ($action != "login") ChkLogin();

switch ($action){
	case "login":           Login(); break;
	case "logout":          OutLogin(); break;
	case "menu":            PhilMenu(); break;
	case "main":            PhilMain(); break;
	case "top":             Philtop(); break;
	case "style":           Philstyle(); break;
	case "d_styleadd":      d_styleadd(); break;
	case "d_styleset":      d_styleset();break;
	case "d_style_preview": d_style_preview();break;
	case "d_toolbar":       d_toolbar();break;
	case "d_toolbutton":    d_toolbutton();break;
	case "styleadd":
	case "styleset":
	case "styledel":
	case "toolbarset":
	case "toolbaradd":
	case "toolbardel":
	case "buttonset":
							DoProductFile($action); break;
	case "d_upload":        d_upload();break;
	case "philchang":       PhilChang();break;
	default:                PhilIndex();break;
} 


function TrimGet($p){
	if (isset($_GET[$p])){
		return trim($_GET[$p]);
	} else{
		return "";
	}
}

function TrimRq($p){
	if (isset($_REQUEST[$p])){
		return trim($_REQUEST[$p]);
	} else{
		return "";
	}
}

function TrimPost($p){
	if (isset($_POST[$p])){
		return trim($_POST[$p]);
	} else{
		return "";
	}
}

//登录检查;
function ChkLogin(){
	session_start();
	if (!isset($_SESSION['editor_admin'])){
		PhilLogin();
		die();
	} 
} 
//退出登录;
function OutLogin(){
	if (isset($_SESSION['editor_admin'])){unset($_SESSION['editor_admin']);}
	ErrorGoto("",PhilSName(),"top");
} 
//登录;
function Login(){
	session_start();
	if ($_POST["uid"]==$GLOBALS["uid"] && $_POST["pwd"]==$GLOBALS["pwd"]){
		$_SESSION['editor_admin'] = $GLOBALS["uid"]."|".$GLOBALS["pwd"];
	} 
	ErrorGoto("",PhilSName(),"top");
} 
//中断处理;
function ErrorGoto($ss,$url,$win){
	if ($ss==""){
		echo "<script language=\"javascript\" type=\"text/javascript\">".$win.".location='".$url."';</script>";
	}else{
		echo "<script language=\"javascript\" type=\"text/javascript\">alert('".$ss."');".$win.".location='".$url."';</script>";
	} 
	die();
} 
function ErrorBack($ss){
	echo "<script language=\"javascript\" type=\"text/javascript\">alert('".$ss."');history.go(-1)</script>";
	die();
} 

function PhilSName(){
	return $_SERVER["SCRIPT_NAME"];
} 
//取所有皮肤;
function GetSkin($s_CurrDir){
	if (is_dir($s_CurrDir)){
		if ($handle = opendir($s_CurrDir)){
			while (false !== ($file = readdir($handle))){
				$sFileType = filetype($s_CurrDir.$file);
				if ($sFileType == "dir"){
					if (($file != ".") && ($file != "..")){
						$oDirs[] = $file;
					}
				}
			}
		}
		if (isset($oDirs)){
			$i = 0;
			foreach($oDirs as $oDir){
				echo "<OPTION value='" . $oDir . "'>" . $oDir . "</OPTION>";
				$i++;
			}
		}

	}
} 


function d_style_preview(){

?>
<table width="<?php   echo TrimGet("w");?>" align=center><tr><td>
	<form id="editor" name="editor" method="post" action="">
    <textarea name="d_content" style="display:none" rows="1" cols="20">test</textarea>
	<IFRAME ID="eWebEditor" src="../ewebeditor.htm?id=d_content&style=<?php   echo TrimGet("style");?>&ext=php" frameborder="0" scrolling="no" width="<?php   echo TrimGet("w");?>" height="<?php   echo TrimGet("h");?>"></IFRAME>
	</form>
<TABLE style="BORDER-BOTTOM: #cccccc 1px dotted; BORDER-LEFT: #cccccc 1px dotted; TABLE-LAYOUT: fixed; BORDER-TOP: #cccccc 1px dotted; BORDER-RIGHT: #cccccc 1px dotted" border=0 cellSpacing=0 cellPadding=6 width="<?php   echo TrimGet("w");?>" align=center>
<TBODY>
<TR>
<TD style="WORD-WRAP: break-word" bgColor=#f3f3f3><FONT style="COLOR: #888888; FONT-WEIGHT: bold">
 &lt;textarea name="d_content" style="display:none" rows="1" cols="20"&gt;test&lt;/textarea&gt;<BR>&nbsp;&lt;IFRAME ID="eWebEditor" src="../ewebeditor.htm?id=d_content&amp;style=<?php   echo TrimGet("style");?>&amp;ext=php" frameborder="0" scrolling="no" width="<?php   echo TrimGet("w");?>" height="<?php   echo TrimGet("h");?>"&gt;&lt;/IFRAME&gt;
</FONT><BR></TD></TR></TBODY></TABLE>
</td></tr></table>
<?php 

} 

//样式列表;
function Philstyle(){

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:12px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
}
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:left;
		margin-top:10px;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;}
TABLE.List {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 2px; BORDER-TOP: 0px; PADDING-LEFT: 2px; PADDING-BOTTOM: 1px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 1px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.List TH {
	COLOR: #ffffff; HEIGHT: 26px; BACKGROUND-COLOR: #799ae1
}
TABLE.List TD {
	PADDING-LEFT: 5px; LINE-HEIGHT: 20px; BACKGROUND-COLOR: #d6dff7
}
 A:link {COLOR: #333333; TEXT-DECORATION: underline;}
 A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
 A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
</style>
</head>
<body>
<DIV CLASS="main">
<div class="div1">当前位置：样式管理</div>
<?php   styletop();?>
<div class="div3">以下为当前所有样式列表：</div>
<div class="div4">
<TABLE class=list cellSpacing=1 cellPadding=0 align=center border=0>
  <FORM name=myform action=?action=del method=post>
  <TBODY>
  <TR align=middle>
    <TH width="12%"align=center>样式名</TH>
    <TH width="10%"align=center>最佳宽度</TH>
    <TH width="10%"align=center>最佳高度</TH>
    <TH width="42%">说明</TH>
    <TH width="26%" align=center>管理</TH></TR>
<?php 
	$Mystyle = $GLOBALS["Mystyle"];
  for ($i=0; $i<=GetUbound($Mystyle); $i=$i+1){
?>
  <TR align=middle>
    <TD><?php     echo $Mystyle[$i][0][0];?></TD>
    <TD><?php     echo $Mystyle[$i][0][1];?></TD>
    <TD><?php     echo $Mystyle[$i][0][2];?></TD>
    <TD align=left><?php     echo $Mystyle[$i][0][3];?></TD>
    <TD>
	<A href="<?php     echo PhilSName();?>?action=d_style_preview&style=<?php     echo $Mystyle[$i][0][0];?>&w=<?php     echo $Mystyle[$i][0][1];?>&h=<?php     echo $Mystyle[$i][0][2];?>" target="_blank">代码+预览</A> | 
	<A href="<?php     echo PhilSName();?>?action=d_styleset&id=<?php     echo $i;?>">设置</A> | 
	<A href="<?php     echo PhilSName();?>?action=d_toolbar&id=<?php     echo $i;?>">工具栏</A> | 
	<A href="<?php     echo PhilSName();?>?action=d_styleset&sAction=copy&id=<?php     echo $i;?>">拷贝</A> | 
	<A onclick="return confirm('提示：您确定要删除此样式吗？')" 
      href="<?php     echo PhilSName();?>?action=styledel&id=<?php     echo $i;?>">删除</A>
	</TD></TR>
<?php 

  }

?>
</TBODY>
</TABLE>
</div>
<div class="div3">提示：你可以通过“拷贝”一样式以达到快速新建样式的目的。</div>
</div>
</body>
</html>
<?php 

} 

//设置按纽;
function d_toolbutton(){

	$Mystyle = $GLOBALS["Mystyle"];
	$id = $GLOBALS["id"];
	$tid = $GLOBALS["tid"];
	$EditorBasePath = $GLOBALS["EditorBasePath"];

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:10px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
}
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:left;
		margin:10px 0 10px 0;
}
.div4 {width:100%;BORDER: 2px #ffffff solid;margin-top:10px;background:#d6dff7;}
table {font-size:12px;}
TABLE.Form {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 4px; BORDER-TOP: 0px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 4px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.Form TH {
	FONT-SIZE: 9pt; COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1
}
TABLE.Form TD {
	PADDING-LEFT: 5px; LINE-HEIGHT: 20px; BACKGROUND-COLOR: #d6dff7
}
 A:link {COLOR: #333333; TEXT-DECORATION: underline;}
 A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
 A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
 input {	BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px; HEIGHT: 18px; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc;font-size:9pt;}
.TB_Btn_Image {MARGIN: 2px; OVERFLOW: hidden; WIDTH: 16px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 16px;}
.TB_Btn_Image IMG {POSITION: relative;}
 DIV.Node1 {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; CURSOR: default; COLOR: #000000; PADDING-TOP: 0px; WHITE-SPACE: nowrap; BACKGROUND-COLOR: #ffffff
}
DIV.Node1 TD {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; CURSOR: default; COLOR: #000000; PADDING-TOP: 0px; WHITE-SPACE: nowrap; BACKGROUND-COLOR: #ffffff
}
DIV.Node2 {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; CURSOR: default; COLOR: #ffffff; PADDING-TOP: 0px; WHITE-SPACE: nowrap; BACKGROUND-COLOR: #0a246a
}
DIV.Node2 TD {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; CURSOR: default; COLOR: #ffffff; PADDING-TOP: 0px; WHITE-SPACE: nowrap; BACKGROUND-COLOR: #0a246a
}
</style>
<script language="javascript" type="text/javascript" src="<?php   echo $EditorBasePath;?>js/private.js"></script>
</head>
<body>
<DIV CLASS="main">
<div class="div1">当前位置：样式管理 - 按纽设置</div>
<?php   styletop();?>
<div class="div3">当前样式：<SPAN 
      class=red><?php   echo $Mystyle[$id][0][0];?></SPAN>&nbsp;&nbsp;当前工具栏：<SPAN 
      class=red><?php   echo $Mystyle[$id][1][$tid][0];?></SPAN></div>

<div class="div4">
<script language="javascript" type="text/javascript" src="<?php   echo $EditorBasePath;?>js/buttons.js"></script>
<script language="javascript" type="text/javascript" src="<?php   echo $EditorBasePath;?>language/zh-cn.js"></script>

<TABLE cellSpacing=0 cellPadding=5 align=center border=0>
  <FORM name=myform action="<?php   echo PhilSName();?>?action=buttonset&id=<?php   echo $id;?>&tid=<?php   echo $tid;?>" method=post>
  <TBODY>
  <TR align=middle>
    <TD>可选按钮</TD>
    <TD></TD>
    <TD>已选按钮</TD>
    <TD></TD></TR>
  <TR>
    <TD>
      <DIV id=div1 
      style="BORDER-RIGHT: 1.5pt inset; PADDING-RIGHT: 0px; BORDER-TOP: 1.5pt inset; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; OVERFLOW: auto; BORDER-LEFT: 1.5pt inset; WIDTH: 250px; PADDING-TOP: 0px; BORDER-BOTTOM: 1.5pt inset; HEIGHT: 350px; BACKGROUND-COLOR: white"></DIV></TD>
    <TD><INPUT onclick=Add() type=button value=" → " name=b1><BR><BR><INPUT onclick=Del() type=button value=" ← " name=b1></TD>
    <TD>
      <DIV id=div2 
      style="BORDER-RIGHT: 1.5pt inset; PADDING-RIGHT: 0px; BORDER-TOP: 1.5pt inset; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; OVERFLOW: auto; BORDER-LEFT: 1.5pt inset; WIDTH: 250px; PADDING-TOP: 0px; BORDER-BOTTOM: 1.5pt inset; HEIGHT: 350px; BACKGROUND-COLOR: white"></DIV></TD>
    <TD><INPUT onclick=Up() type=button value=↑ name=b3><BR><BR><BR><INPUT onclick=Down() type=button value=↓ name=b4></TD></TR>
	<INPUT type=hidden value="<?php   echo str_replace(",","|",trim($Mystyle[$id][1][$tid][1]));?>" name=d_button> 
  <TR>
    <TD align=right 
  colSpan=4><INPUT type=submit value=" 保存设置 " name=b></TD></TR></FORM></TBODY></TABLE>
<SCRIPT language="javascript">
	initButtonOptions("<?php   echo $Mystyle[$id][0][6];?>");
</SCRIPT>

</div>
<div class="div3">提示：你可以通过按“Ctrl”“Shift”来快速多选定，可以在指定项上“双击”快速增加或删除项。可以选定多个按钮同时上移或下移操作。</div>
</div>
</body>
</html>
<?php 

} 

//设置工具栏;
function d_toolbar(){

	$Mystyle = $GLOBALS["Mystyle"];
	$id = $GLOBALS["id"];
	$tid = $GLOBALS["tid"];

	$tbub = count($Mystyle[$id][1])-1;

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:10px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
}
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:left;
		margin:10px 0 10px 0;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;}
table {font-size:12px;}
TABLE.Form {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 4px; BORDER-TOP: 0px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 4px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.Form TH {
	FONT-SIZE: 9pt; COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1
}
TABLE.Form TD {
	PADDING-LEFT: 5px; LINE-HEIGHT: 20px; BACKGROUND-COLOR: #d6dff7
}
 A:link {COLOR: #333333; TEXT-DECORATION: underline;}
 A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
 A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
 input {	BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px; HEIGHT: 18px; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc;font-size:9pt;}
</style>
</head>
<body>
<DIV CLASS="main">
<div class="div1">当前位置：样式管理 - 工具栏设置</div>
<?php   styletop();?>
<div class="div3">样式（<?php   echo $Mystyle[$id][0][0];?>）下的工具栏管理：</div>

<HR align=center width="80%" SIZE=1>
<TABLE cellSpacing=0 cellPadding=4 align=center border=0>
  <FORM name=addform action="<?php   echo PhilSName();?>?action=toolbaradd&id=<?php   echo $id;?>" method=post>
  <TBODY>
  <TR>
    <TD>工具栏名：<INPUT class=input value=工具栏<?php   echo $tbub+2;?> name=d_name> 排序号：<INPUT class=input 
      size=5 value=<?php   echo $tbub+2;?> name=d_order> 
  <INPUT type=submit value=新增工具栏 name=b1></TD></TR></FORM></TBODY></TABLE>
<HR align=center width="80%" SIZE=1>
<div class="div4">
<TABLE class=form cellSpacing=1 cellPadding=0 align=center border=0>
<FORM name=modiform action="<?php   echo PhilSName();?>?action=toolbarset&id=<?php   echo $id;?>" method=post>
  <TBODY>
  <TR align=middle>
    <TH>ID</TH>
    <TH>工具栏名</TH>
    <TH>排序号</TH>
    <TH>操作</TH></TR>
<?php 
  for ($j=0; $j<=$tbub; $j=$j+1){
?>
  <TR align=middle>
    <TD><?php     echo $j+1;?></TD>
    <TD><INPUT class=input size=30 value=<?php     echo $Mystyle[$id][1][$j][0];?> name=d_name[]></TD>
    <TD><INPUT class=input size=5 value=<?php     echo $j+1;?> name=d_order[]></TD>
    <TD>
	  <A href="<?php     echo PhilSName();?>?action=d_toolbutton&id=<?php     echo $id;?>&tid=<?php     echo $j;?>">按钮设置</A> | 
	  <A href="<?php     echo PhilSName();?>?action=toolbardel&id=<?php     echo $id;?>&tid=<?php     echo $j;?>">删除</A></TD></TR>
<?php 

  }

?>
  <TR>
    <TD align=middle 
  colSpan=4><INPUT type=submit value="  修改  " name=b1></TD></TR></TBODY></FORM></TABLE>
</div>
<div class="div3">提示：无论狂风暴雨，情歌只听张宇。</div>
</div>
</body>
</html>
<?php 
  return $function_ret;
} 

//添加新样式;
function d_styleadd(){

	$EditorBasePath = $GLOBALS["EditorBasePath"];

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style type="text/css">
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:10px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
}
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:left;
		margin-top:10px;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;}
TABLE.Form {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 4px; BORDER-TOP: 0px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 4px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.Form TH {FONT-SIZE: 9pt; COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1;}
TABLE.Form TD {PADDING:2px 0 2px 10px; LINE-HEIGHT: 20px; BACKGROUND-COLOR: #d6dff7;}
a:link {COLOR: #333333; TEXT-DECORATION: underline;}
a:visited {COLOR: #333333; TEXT-DECORATION: underline;}
a:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
input {	BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px; HEIGHT: 18px; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc;font-size:9pt;}
}

</style>
<script language="javascript" type="text/javascript" src="<?php   echo $EditorBasePath;?>js/private.js"></script>

</head>
<body>
<div class="main">
<div class="div1">当前位置：样式管理 - 新增样式</div>
<?php   styletop();?>
<div class="div4">
<TABLE class=form cellSpacing=1 cellPadding=0 align=center border=0>
  <FORM name=myform onsubmit="return checkStyleSetForm(this)" action="?action=styleadd" method=post>
  <TBODY>
  <TR>
    <TH colSpan=4>新增样式（鼠标移到输入框可看说明，带*号为必填项）</TH></TR>
  <TR>
    <TD width="15%">样式名称：</TD>
    <TD width="35%"><INPUT class=input title=引用此样式的名字，不要加特殊符号 name=d_name> 
      <font color=red>*</font></TD>
    <TD width="15%">初始模式：</TD>
    <TD width="35%"><SELECT size=1 name=d_initmode><OPTION 
        value=CODE>代码模式</OPTION><OPTION value=EDIT selected>编辑模式</OPTION><OPTION 
        value=TEXT>文本模式</OPTION><OPTION value=VIEW>预览模式</OPTION></SELECT><font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">限宽模式宽度：</TD>
    <TD width="35%"><INPUT class=input title=留空表示不启用，可以填入如：500px 
      name=d_fixwidth></TD>
    <TD width="15%">界面皮肤目录：</TD>
    <TD width="35%"><INPUT class=input title=存放界面皮肤文件的目录名，必须在skin下 size=15 
      value=office2003 name=d_skin>
	  <SELECT id=d_skin_drop onchange=this.form.d_skin.value=this.value size=1>
	  <OPTION selected>-系统自带-</OPTION>

         <?php   GetSkin($EditorBasePath."skin/");?>
	  </SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">最佳宽度：</TD>
    <TD width="35%"><INPUT class=input title=最佳引用效果的宽度，数字型 value=550 
      name=d_width> <font color=red>*</font></TD>
    <TD width="15%">最佳高度：</TD>
    <TD width="35%"><INPUT class=input title=最佳引用效果的高度，数字型 value=350 
      name=d_height> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">显示状态栏及按钮：</TD>
    <TD width="35%"><INPUT type=checkbox CHECKED value=1 name=d_stateflag>状态栏 
      <INPUT type=checkbox CHECKED value=1 name=d_sbcode>代码 <INPUT type=checkbox 
      CHECKED value=1 name=d_sbedit>编辑 <INPUT type=checkbox CHECKED value=1 
      name=d_sbtext>文本 <INPUT type=checkbox CHECKED value=1 
      name=d_sbview>预览<font color=red>*</font></TD>
    <TD width="15%">Word粘贴：</TD>
    <TD width="35%"><SELECT size=1 name=d_detectfromword><OPTION value=1 
        selected>自动检测有提示</OPTION><OPTION value=0>不自动检测</OPTION></SELECT><font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">远程文件：</TD>
    <TD width="35%"><SELECT size=1 name=d_autoremote><OPTION value=1 
        selected>自动上传</OPTION><OPTION value=0>不自动上传</OPTION></SELECT><font color=red>*</font></TD>
    <TD width="15%">指导方针：</TD>
    <TD width="35%"><SELECT size=1 name=d_showborder><OPTION 
        value=1>默认显示</OPTION><OPTION value=0 selected>默认不显示</OPTION></SELECT> 
      <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">自动语言检测：</TD>
    <TD width="35%"><SELECT size=1 name=d_autodetectlanguage><OPTION value=1 
        selected>自动检测</OPTION><OPTION value=0>不自动检测</OPTION></SELECT><font color=red>*</font></TD>
    <TD width="15%">默认语言：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_defaultlanguage>
	    <OPTION value=zh-cn selected>简体中文</OPTION>
	    <OPTION value=zh-tw>繁体中文</OPTION>
		<OPTION value=en>英文</OPTION>
		<OPTION value=ja>日语</OPTION>
		<OPTION value=es>西班牙语</OPTION>
		<OPTION value=ru>俄语</OPTION>
		<OPTION value=de>德语</OPTION>
		<OPTION value=fr>法语</OPTION>
		<OPTION value=it>意大利语</OPTION>
		<OPTION value=nl>荷兰语</OPTION>
		<OPTION value=sv>瑞典语</OPTION>
		<OPTION value=pt>葡萄牙语</OPTION>
		<OPTION value=no>挪威语</OPTION>
		<OPTION value=da>丹麦语</OPTION>
		</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">回车换行模式：</TD>
    <TD width="35%"><SELECT size=1 name=d_entermode><OPTION value=1 
        selected>Enter输入&lt;P&gt;，Shift+Enter输入&lt;BR&gt;</OPTION><OPTION 
        value=2>Enter输入&lt;BR&gt;，Shift+Enter输入&lt;P&gt;</OPTION></SELECT><font color=red>*</font></TD>
    <TD width="15%">编辑区CSS模式：</TD>
    <TD width="35%"><SELECT size=1 name=d_areacssmode><OPTION value=0 
        selected>常规模式</OPTION><OPTION value=1>Word导入模式</OPTION></SELECT><font color=red>*</font></TD></TR>
<TR>
    <TD>上传脚本：</TD>
    <TD>	
	<SELECT size=1 name=d_serverext>
	<OPTION value=asp>PHP</OPTION>
	<OPTION value=php selected>ASP</OPTION>
    <OPTION value=aspx>ASPX</OPTION>
	<OPTION value=jsp>JSP</OPTION>
	</SELECT>
	</TD>
    <TD>备注说明：</TD>
    <TD><INPUT title=此样式的说明，更有利于调用 size=40 value="" name=d_memo></TD>
	</TR>
  <TR>
    <TD colSpan=4><font 
      color=red>&nbsp;&nbsp;&nbsp;上传相关设置（相关设置说明详见用户手册）：</font></TD></TR>
  <TR>
    <TD width="15%">上传组件：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_uploadobject>
	<OPTION value=0 selected>PHP内置</OPTION>
	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">年月日自动目录：</TD>
    <TD width="35%"><SELECT size=1 name=d_autodir><OPTION value=0 
        selected>不使用</OPTION><OPTION value=1>年目录</OPTION><OPTION 
        value=2>年月目录</OPTION><OPTION value=3>年月日目录</OPTION></SELECT>
		<font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">上传文件浏览：</TD>
    <TD width="35%"><SELECT size=1 name=d_allowbrowse><OPTION 
        value=1>是,开启</OPTION><OPTION value=0 selected>否,关闭</OPTION></SELECT> <SPAN 
      class=red>*</SPAN></TD>
    <TD width="15%">自定上传路径接口：</TD>
    <TD width="35%"><SELECT size=1 name=d_cusdirflag><OPTION value=0 
        selected>禁用</OPTION><OPTION value=1>启用</OPTION></SELECT></TD></TR>
  <TR>
    <TD width="15%">路径模式：</TD>
    <TD width="35%"><SELECT size=1 name=d_baseurl><OPTION 
        value=0>相对路径</OPTION><OPTION value=1 selected>绝对根路径</OPTION><OPTION 
        value=2>绝对全路径</OPTION><OPTION value=3>站外绝对全路径</OPTION></SELECT> <font color=red>*</font> <A 
      href="#baseurl">说明</A></TD>
    <TD width="15%">上传路径：</TD>
    <TD width="35%"><INPUT class=input title=上传文件所存放路径，相对eWebEditor根目录文件的路径 
      value=uploadfile/ name=d_uploaddir> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">显示路径：</TD>
    <TD width="35%"><INPUT class=input title='显示内容页所存放路径，必须以"/"开头' 
      name=d_basehref></TD>
    <TD width="15%">内容路径：</TD>
    <TD width="35%"><INPUT class=input title='实际保存在内容中的路径，相对显示路径的路径，不能以"/"开头' 
      name=d_contentpath></TD></TR>
  <TR>
    <TD colSpan=4><font color=red>&nbsp;&nbsp;&nbsp;允许上传文件类型及文件大小设置（文件大小单位为KB，0表示不允许）：</font></TD></TR>
  <TR>
    <TD width="15%">图片类型：</TD>
    <TD width="35%"><INPUT class=input title=用于图片相关的上传 value=gif|jpg|jpeg|bmp name=d_imageext size="40"></TD>
    <TD width="15%">图片限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=1024 name=d_imagesize>KB</TD></TR>
  <TR>
    <TD width="15%">Flash类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入Flash动画 value=swf name=d_flashext size="40"></TD>
    <TD width="15%">Flash限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=1000 name=d_flashsize>KB</TD></TR>
  <TR>
    <TD width="15%">媒体类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入媒体文件 value=rm|mp3|wav|mid|midi|ra|avi|mpg|mpeg|asf|asx|wma|mov name=d_mediaext size="40"></TD>
    <TD width="15%">媒体限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=100 name=d_mediasize>KB</TD></TR>
  <TR>
    <TD width="15%">附件类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入附件 value=rar|zip|txt|doc|xls|ppt|chm|hlp name=d_fileext size="40"></TD>
    <TD width="15%">附件限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=500 name=d_filesize>KB</TD></TR>
  <TR>
    <TD width="15%">远程类型：</TD>
    <TD width="35%"><INPUT class=input title=用于自动上传远程文件 value=gif|jpg|bmp name=d_remoteext size="40"></TD>
    <TD width="15%">远程限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=100 name=d_remotesize>KB</TD></TR>
  <TR>
    <TD width="15%">本地类型：</TD>
    <TD width="35%"><INPUT class=input title=用于自动上传本地文件 value=gif|jpg|bmp|wmz name=d_localext size="40"></TD>
    <TD width="15%">本地限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=100 name=d_localsize>KB</TD></TR>
  <TR>
    <TD colSpan=4><font color=red>&nbsp;&nbsp;&nbsp;缩略图及水印相关设置：</font></TD></TR>
  <TR>
    <TD width="15%">图形处理组件：</TD>
    <TD width="35%"><SELECT size=1 name=d_sltsyobject><OPTION value=0 
        selected>PHP GD2图形库</OPTION></SELECT></TD>
    <TD width="15%">处理图形扩展名：</TD>
    <TD width="35%"><INPUT class=input value=bmp|jpg|jpeg|gif 
    name=d_sltsyext></TD></TR>
  <TR>
    <TD width="15%">缩略图使用状态：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sltflag>
	<OPTION value=1>使用</OPTION>
	<OPTION value=0 selected>不使用</OPTION>
    <OPTION value=2>前台用户控制</OPTION>
	</SELECT>
	</TD>
    <TD width="15%">缩略图长度条件：</TD>
    <TD width="35%"><INPUT class=input title=图形的长度只有达到此最小长度要求时才会生成缩略图，数字型 
      value=300 name=d_sltminsize>px</TD></TR>
  <TR>
    <TD width="15%">缩略图生成长度：</TD>
    <TD width="35%"><INPUT class=input title=生成的缩略图长度值，数字型 value=120 
      name=d_sltoksize>px</TD>
    <TD width="15%">&nbsp;</TD>
    <TD width="35%">&nbsp;</TD></TR>
  <TR>
    <TD width="15%">文字水印使用状态：</TD>
    <TD width="35%"><SELECT size=1 name=d_sywzflag><OPTION value=0 
        selected>不使用</OPTION><OPTION value=1>使用</OPTION><OPTION 
        value=2>前台用户控制</OPTION></SELECT></TD>
    <TD width="15%">文字水印启用条件：</TD>
    <TD width="35%">宽:<INPUT class=input title=图形的宽度只有达到此最小宽度要求时才会生成水印，数字型 
      size=4 value=100 name=d_sywzminwidth>px&nbsp; 高:<INPUT class=input 
      title=图形的高度只有达到此最小高度要求时才会生成水印，数字型 size=4 value=100 
    name=d_sywzminheight>px</TD></TR>
  <TR>
    <TD width="15%">文字水印内容：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时的文字内容 value=版权所有... 
      name=d_sytext></TD>
    <TD width="15%">文字水印字体颜色：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的颜色 value=000000 
      name=d_syfontcolor></TD></TR>
  <TR>
    <TD width="15%">文字水印阴影颜色：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时的文字阴影颜色 value=FFFFFF 
      name=d_syshadowcolor></TD>
    <TD width="15%">文字水印阴影大小：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的阴影大小 value=1 
      name=d_syshadowoffset>px</TD></TR>
  <TR>
    <TD width="15%">文字水印字体大小：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的字体大小 value=12 
      name=d_syfontsize>px</TD>
    <TD width="15%">中文字体库及路径：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的字体名 value="C:\WINDOWS\Fonts\simkai.ttf" 
      name=d_syfontname size=30>&nbsp;&nbsp;<a href="#baseurl2">说明</a></TD></TR>
  <TR>
    <TD width="15%">文字水印位置：</TD>
    <TD width="35%"><SELECT size=1 name=d_sywzposition><OPTION value=1 
        selected>左上</OPTION><OPTION value=2>左中</OPTION><OPTION 
        value=3>左下</OPTION><OPTION value=4>中上</OPTION><OPTION 
        value=5>中中</OPTION><OPTION value=6>中下</OPTION><OPTION 
        value=7>右上</OPTION><OPTION value=8>右中</OPTION><OPTION 
      value=9>右下</OPTION></SELECT></TD>
    <TD width="15%">文字水印边距：</TD>
    <TD width="35%">左右:<INPUT class=input title=居左时作用为左边距，居右时作用为右边距，数字型 size=4 
      value=5 name=d_sywzpaddingh>px&nbsp; 上下:<INPUT class=input 
      title=居上时作用为上边距，居下时作用为下边柜，数字型 size=4 value=5 name=d_sywzpaddingv>px</TD></TR>
  <TR>
    <TD width="15%">文字水印文字占位：</TD>
    <TD width="35%">宽:<INPUT class=input title=水印文字的占位宽度，由字数、字体大小等设置的效果确定，数字型 
      size=4 value=66 name=d_sywztextwidth>px&nbsp; 高:<INPUT class=input 
      title=水印文字的占位高度，由字数、字体大小等设置的效果确定，数字型 size=4 value=17 
      name=d_sywztextheight>px&nbsp; <INPUT onclick=doCheckWH(1) type=button value=检测宽高></TD>
    <TD width="15%"></TD>
    <TD width="35%"></TD></TR>
  <TR>
    <TD width="15%">图片水印使用状态：</TD>
    <TD width="35%"><SELECT size=1 name=d_sytpflag><OPTION value=0 
        selected>不使用</OPTION><OPTION value=1>使用</OPTION><OPTION 
        value=2>前台用户控制</OPTION></SELECT></TD>
    <TD width="15%">图片水印启用条件：</TD>
    <TD width="35%">宽:<INPUT class=input title=图形的宽度只有达到此最小宽度要求时才会生成水印，数字型 
      size=4 value=100 name=d_sytpminwidth>px&nbsp; 高:<INPUT class=input 
      title=图形的高度只有达到此最小高度要求时才会生成水印，数字型 size=4 value=100 
    name=d_sytpminheight>px</TD></TR>
  <TR>
    <TD width="15%">图片水印位置：</TD>
    <TD width="35%"><SELECT size=1 name=d_sytpposition><OPTION value=1 
        selected>左上</OPTION><OPTION value=2>左中</OPTION><OPTION 
        value=3>左下</OPTION><OPTION value=4>中上</OPTION><OPTION 
        value=5>中中</OPTION><OPTION value=6>中下</OPTION><OPTION 
        value=7>右上</OPTION><OPTION value=8>右中</OPTION><OPTION 
      value=9>右下</OPTION></SELECT></TD>
    <TD width="15%">图片水印边距：</TD>
    <TD width="35%">左右:<INPUT class=input title=居左时作用为左边距，居右时作用为右边距，数字型 size=4 
      value=5 name=d_sytppaddingh>px&nbsp; 上下:<INPUT class=input 
      title=居上时作用为上边距，居下时作用为下边柜，数字型 size=4 value=5 name=d_sytppaddingv>px</TD></TR>
  <TR>
    <TD width="15%">图片水印图片路径：</TD>
    <TD width="35%"><INPUT class=input title=当使用图片水印时图片的路径 
name=d_sypicpath value="sy.jpg"></TD>
    <TD width="15%">图片水印透明度：</TD>
    <TD width="35%"><INPUT class=input title=0至1间的数字，如0.5表示半透明 value=1 
      name=d_sytpopacity></TD></TR>
  <TR>
    <TD width="15%">图片水印图片占位：</TD>
    <TD width="35%">宽:<INPUT class=input title=水印图片的宽度，数字型 size=4 value=88 
      name=d_sytpimagewidth>px&nbsp; 高:<INPUT class=input title=水印图片的高度，数字型 
      size=4 value=31 name=d_sytpimageheight>px&nbsp; <INPUT onclick=doCheckWH(2) type=button value=检测宽高></TD>
    <TD width="15%"></TD>
    <TD width="35%"></TD></TR>
  <TR>
    <TD width="15%">水印宽高检测区：</TD>
    <TD width="85%" colSpan=3><SPAN id=tdPreview></SPAN></TD></TR>
  <TR>
    <TD align=middle colSpan=4><INPUT type=submit align=absMiddle value="  添加  ">&nbsp;<INPUT type=reset value="  重填  " name=btnReset></TD></TR></FORM></TBODY></TABLE>
</div>
<div class="div3">
	<a name=baseurl>路径模式设置说明：</a>
	<ul type=square>
	<li>相对路径：指所有的相关上传或自动插入文件路径，编辑后都以"UploadFile/..."或"../UploadFile/..."形式呈现，当使用此模式时，显示路径和内容路径必填，显示路径必须以"/"开头和结尾，内容路径设置中不能以"/"开头。
	<li>绝对根路径：指所有的相关上传或自动插入文件路径，编辑后都以"/eWebEditor/UploadFile/..."这种形式呈现，当使用此模式时，显示路径和内容路径不必填。
	<li>绝对全路径：指所有的相关上传或自动插入文件路径，编辑后都以"http://xxx.xxx.xxx/eWebEditor/UploadFile/..."这种形式呈现，当使用此模式时，显示路径和内容路径不必填。
	<li>站外绝对全路径：当使用此模式时，上传路径必须是实际物理路径，如："c:\xxx\"；显示路径为空；内容路径必须以"http"开头。
	</ul>
	<a name=baseurl2><font color=blue><b>中文字体库及路径：</b></font></a>
	<ul type=square>
	<li><font color=red><b>PHP很讨厌，非得指向具体的字库。否则，文字水印中的中文（全角字符）会乱码。如果服务器系统字体不可用，可把字体文件上传至WEB目录。</b></font>
	</ul>
</div>
</div>
</body>
</html>
<?php 

} 

//修改样式;
function d_styleset(){

	$Mystyle = $GLOBALS["Mystyle"];
	$id = $GLOBALS["id"];
	$tid = $GLOBALS["tid"];
	$EditorBasePath = $GLOBALS["EditorBasePath"];

	$sAction = TrimRq("saction");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style type="text/css">
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:10px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
}
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:left;
		margin-top:10px;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;}
TABLE.Form {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 4px; BORDER-TOP: 0px; PADDING-LEFT: 4px; PADDING-BOTTOM: 4px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 4px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.Form TH {FONT-SIZE: 9pt; COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1;}
TABLE.Form TD {PADDING:2px 0 2px 10px; LINE-HEIGHT: 20px; BACKGROUND-COLOR: #d6dff7;}
a:link {COLOR: #333333; TEXT-DECORATION: underline;}
a:visited {COLOR: #333333; TEXT-DECORATION: underline;}
a:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
input {	BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px; HEIGHT: 18px; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc;font-size:9pt;}
}

</style>
<script language="javascript" type="text/javascript" src="<?php   echo $EditorBasePath;?>js/private.js"></script>
<?php //call js_public() ?>
</head>
<body>
<div class="main">
<div class="div1">当前位置：样式管理 - <?php   if ($sAction=="copy")
  {
?>复制<?php   }
    else
  {
?>修改<?php   } ?>样式</div>
<?php   styletop();?>
<div class="div4">
<TABLE class=form cellSpacing=1 cellPadding=0 align=center border=0>
<?php 
  if ($sAction=="copy")
  {

?>
  <FORM name=myform onsubmit="return checkStyleSetForm(this)" action="?action=styleadd" method=post>
  <TBODY>
  <TR>
    <TH colSpan=4>&nbsp;&nbsp;以样式(<?php     echo $Mystyle[$id][0][0];?>)为副本新建样式（鼠标移到输入框可看说明，带*号为必填项）</TH></TR>
  <TR>
    <TD width="15%">样式名称：</TD>
    <TD width="35%"><INPUT type=text class=input title=引用此样式的名字，不要加特殊符号 
      value="<?php     echo $Mystyle[$id][0][0];?>_copy" name=d_name> <font color=red>*</font></TD>
<?php   }
    else
  {
?>
  <FORM name=myform onsubmit="return checkStyleSetForm(this)" action="?action=styleset&id=<?php     echo $id;?>" method=post>
  <TBODY>
  <TR>
    <TH colSpan=4>&nbsp;&nbsp;设置样式(<?php     echo $Mystyle[$id][0][0];?>)（鼠标移到输入框可看说明，带*号为必填项）</TH></TR>
  <TR>
    <TD width="15%">样式名称：</TD>
    <TD width="35%">&nbsp;<?php     echo $Mystyle[$id][0][0];?><INPUT type=hidden class=input title=引用此样式的名字，不要加特殊符号 
      value="<?php     echo $Mystyle[$id][0][0];?>" name=d_name> <font color=red>*</font></TD>
<?php   } ?>
    <TD width="15%">初始模式：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_initmode>
	<OPTION value=CODE<?php   if ($Mystyle[$id][0][4]=="CODE")
  {
?> selected<?php   } ?>>代码模式</OPTION>
	<OPTION value=EDIT<?php   if ($Mystyle[$id][0][4]=="EDIT")
  {
?> selected<?php   } ?>>编辑模式</OPTION>
	<OPTION value=TEXT<?php   if ($Mystyle[$id][0][4]=="TEXT")
  {
?> selected<?php   } ?>>文本模式</OPTION>
	<OPTION value=VIEW<?php   if ($Mystyle[$id][0][4]=="VIEW")
  {
?> selected<?php   } ?>>预览模式</OPTION>
	</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">限宽模式宽度：</TD>
    <TD width="35%"><INPUT class=input title=留空表示不启用，可以填入如：500px 
      name=d_fixwidth value="<?php   echo $Mystyle[$id][0][5];?>"></TD>
    <TD width="15%">界面皮肤目录：</TD>
    <TD width="35%"><INPUT class=input title=存放界面皮肤文件的目录名，必须在skin下 size=15 
      value="<?php   echo $Mystyle[$id][0][6];?>" name=d_skin> 
	  <SELECT id=d_skin_drop 
      onchange=this.form.d_skin.value=this.value size=1>
	  <OPTION selected>-系统自带-</OPTION>
      <?php   GetSkin($EditorBasePath."skin/");?>
	  </SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">最佳宽度：</TD>
    <TD width="35%"><INPUT class=input title=最佳引用效果的宽度，数字型 value=<?php   echo $Mystyle[$id][0][1];?>
      name=d_width> <font color=red>*</font></TD>
    <TD width="15%">最佳高度：</TD>
    <TD width="35%"><INPUT class=input title=最佳引用效果的高度，数字型 value=<?php   echo $Mystyle[$id][0][2];?>
      name=d_height> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">显示状态栏及按钮：</TD>
    <TD width="35%">
	  <INPUT type=checkbox<?php   if ($Mystyle[$id][0][7]=="1")
  {
?> CHECKED<?php   } ?> value=1 name=d_stateflag>状态栏 
      <INPUT type=checkbox<?php   if ($Mystyle[$id][0][8]=="1")
  {
?> CHECKED<?php   } ?> value=1 name=d_sbcode>代码 
	  <INPUT type=checkbox<?php   if ($Mystyle[$id][0][9]=="1")
  {
?> CHECKED<?php   } ?> value=1 name=d_sbedit>编辑 
	  <INPUT type=checkbox<?php   if ($Mystyle[$id][0][10]=="1")
  {
?> CHECKED<?php   } ?> value=1 name=d_sbtext>文本 
	  <INPUT type=checkbox<?php   if ($Mystyle[$id][0][11]=="1")
  {
?> CHECKED<?php   } ?> value=1 name=d_sbview>预览<font color=red>*</font></TD>
    <TD width="15%">Word粘贴：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_detectfromword>
	<OPTION value=1<?php   if ($Mystyle[$id][0][12]=="1")
  {
?> selected<?php   } ?>>自动检测有提示</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][12]=="0")
  {
?> selected<?php   } ?>>不自动检测</OPTION></SELECT> 
	<font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">远程文件：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_autoremote>
	<OPTION value=1<?php   if ($Mystyle[$id][0][13]=="1")
  {
?> selected<?php   } ?>>自动上传</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][13]=="0")
  {
?> selected<?php   } ?>>不自动上传</OPTION>
	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">指导方针：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_showborder>
	<OPTION value=1<?php   if ($Mystyle[$id][0][14]=="1")
  {
?> selected<?php   } ?>>默认显示</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][14]=="0")
  {
?> selected<?php   } ?>>默认不显示</OPTION>
	</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">自动语言检测：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_autodetectlanguage>
	<OPTION value=1<?php   if ($Mystyle[$id][0][15]=="1")
  {
?> selected<?php   } ?>>自动检测</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][15]=="0")
  {
?> selected<?php   } ?>>不自动检测</OPTION>
	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">默认语言：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_defaultlanguage>
	<OPTION value=zh-cn<?php   if ($Mystyle[$id][0][16]=="zh-cn")
  {
?> selected<?php   } ?>>简体中文</OPTION>
	<OPTION value=zh-tw<?php   if ($Mystyle[$id][0][16]=="zh-tw")
  {
?> selected<?php   } ?>>繁体中文</OPTION>
	<OPTION value=en<?php   if ($Mystyle[$id][0][16]=="en")
  {
?> selected<?php   } ?>>英文</OPTION>

	<OPTION value=ja>日语</OPTION>
	<OPTION value=es>西班牙语</OPTION>
	<OPTION value=ru>俄语</OPTION>
	<OPTION value=de>德语</OPTION>
	<OPTION value=fr>法语</OPTION>
	<OPTION value=it>意大利语</OPTION>
	<OPTION value=nl>荷兰语</OPTION>
	<OPTION value=sv>瑞典语</OPTION>
	<OPTION value=pt>葡萄牙语</OPTION>
	<OPTION value=no>挪威语</OPTION>
	<OPTION value=da>丹麦语</OPTION>

	</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">回车换行模式：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_entermode>
	<OPTION value=1<?php   if ($Mystyle[$id][0][17]=="1")
  {
?> selected<?php   } ?>>Enter输入&lt;P&gt;，Shift+Enter输入&lt;BR&gt;</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][17]=="2")
  {
?> selected<?php   } ?>>Enter输入&lt;BR&gt;，Shift+Enter输入&lt;P&gt;</OPTION>
	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">编辑区CSS模式：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_areacssmode>
	<OPTION value=0<?php   if ($Mystyle[$id][0][18]=="0")
  {
?> selected<?php   } ?>>常规模式</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][18]=="1")
  {
?> selected<?php   } ?>>Word导入模式</OPTION>
	</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD>上传脚本：</TD>
    <TD>	
	<SELECT size=1 name=d_serverext>
	<OPTION value=asp<?php   if ($Mystyle[$id][0][19]=="asp")
  {
?> selected<?php   } ?>>ASP</OPTION>
	<OPTION value=php<?php   if ($Mystyle[$id][0][19]=="php")
  {
?> selected<?php   } ?>>PHP</OPTION>
    <OPTION value=aspx<?php   if ($Mystyle[$id][0][19]=="aspx")
  {
?> selected<?php   } ?>>ASPX</OPTION>
	<OPTION value=jsp<?php   if ($Mystyle[$id][0][19]=="jsp")
  {
?> selected<?php   } ?>>JSP</OPTION>
	</SELECT>
	</TD>
    <TD>备注说明：</TD>
    <TD><INPUT title=此样式的说明，更有利于调用 size=40 value="<?php   echo htmlspecialchars($Mystyle[$id][0][3]);?>" name=d_memo></TD>
	</TR>
  <TR>
    <TD colSpan=4><font color=red>&nbsp;&nbsp;&nbsp;上传相关设置（相关设置说明详见用户手册）：</font></TD></TR>
  <TR>
    <TD width="15%">上传组件：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_uploadobject>
	<OPTION value=0<?php   if ($Mystyle[$id][0][20]=="0")
  {
?> selected<?php   } ?>>PHP内置</OPTION>

	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">年月日自动目录：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_autodir>
	<OPTION value=0<?php   if ($Mystyle[$id][0][21]=="0")
  {
?> selected<?php   } ?>>不使用</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][21]=="1")
  {
?> selected<?php   } ?>>年目录</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][21]=="2")
  {
?> selected<?php   } ?>>年月目录</OPTION>
	<OPTION value=3<?php   if ($Mystyle[$id][0][21]=="3")
  {
?> selected<?php   } ?>>年月日目录</OPTION>
	</SELECT> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">上传文件浏览：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_allowbrowse>
	<OPTION value=1<?php   if ($Mystyle[$id][0][22]=="1")
  {
?> selected<?php   } ?>>是,开启</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][22]=="0")
  {
?> selected<?php   } ?>>否,关闭</OPTION>
	</SELECT> <font color=red>*</font></TD>
    <TD width="15%">自定上传路径接口：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_cusdirflag>
	<OPTION value=0<?php   if ($Mystyle[$id][0][23]=="0")
  {
?> selected<?php   } ?>>禁用</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][23]=="1")
  {
?> selected<?php   } ?>>启用</OPTION>
	</SELECT></TD></TR>
  <TR>
    <TD width="15%">路径模式：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_baseurl>
	<OPTION value=0<?php   if ($Mystyle[$id][0][24]=="0")
  {
?> selected<?php   } ?>>相对路径</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][24]=="1")
  {
?> selected<?php   } ?>>绝对根路径</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][24]=="2")
  {
?> selected<?php   } ?>>绝对全路径</OPTION>
	<OPTION value=3<?php   if ($Mystyle[$id][0][24]=="3")
  {
?> selected<?php   } ?>>站外绝对全路径</OPTION>
	</SELECT> <font color=red>*</font> <A 
      href="#baseurl">说明</A></TD>
    <TD width="15%">上传路径：</TD>
    <TD width="35%"><INPUT class=input title=上传文件所存放路径，相对eWebEditor根目录文件的路径 
      value="<?php   echo $Mystyle[$id][0][25];?>" name=d_uploaddir> <font color=red>*</font></TD></TR>
  <TR>
    <TD width="15%">显示路径：</TD>
    <TD width="35%"><INPUT class=input title='显示内容页所存放路径，必须以"/"开头' 
      name=d_basehref value="<?php   echo $Mystyle[$id][0][26];?>"></TD>
    <TD width="15%">内容路径：</TD>
    <TD width="35%"><INPUT class=input title='实际保存在内容中的路径，相对显示路径的路径，不能以"/"开头' 
      name=d_contentpath value="<?php   echo $Mystyle[$id][0][27];?>"></TD></TR>
  <TR>
    <TD colSpan=4><font color=red>&nbsp;&nbsp;&nbsp;允许上传文件类型及文件大小设置（文件大小单位为KB，0表示不允许）：</font></TD></TR>
  <TR>
    <TD width="15%">图片类型：</TD>
    <TD width="35%"><INPUT class=input title=用于图片相关的上传 value=<?php   echo $Mystyle[$id][0][28];?> name=d_imageext size="40"></TD>
    <TD width="15%">图片限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][34];?> name=d_imagesize>KB</TD></TR>
  <TR>
    <TD width="15%">Flash类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入Flash动画 value=<?php   echo $Mystyle[$id][0][29];?> name=d_flashext size="40"></TD>
    <TD width="15%">Flash限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][35];?> name=d_flashsize>KB</TD></TR>
  <TR>
    <TD width="15%">媒体类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入媒体文件 value=<?php   echo $Mystyle[$id][0][30];?> name=d_mediaext size="40"></TD>
    <TD width="15%">媒体限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][36];?> name=d_mediasize>KB</TD></TR>
  <TR>
    <TD width="15%">附件类型：</TD>
    <TD width="35%"><INPUT class=input title=用于插入附件 value=<?php   echo $Mystyle[$id][0][31];?> name=d_fileext size="40"></TD>
    <TD width="15%">附件限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][37];?> name=d_filesize>KB</TD></TR>
  <TR>
    <TD width="15%">远程类型：</TD>
    <TD width="35%"><INPUT class=input title=用于自动上传远程文件 value=<?php   echo $Mystyle[$id][0][32];?> name=d_remoteext size="40"></TD>
    <TD width="15%">远程限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][38];?> name=d_remotesize>KB</TD></TR>
  <TR>
    <TD width="15%">本地类型：</TD>
    <TD width="35%"><INPUT class=input title=用于自动上传本地文件 value=<?php   echo $Mystyle[$id][0][33];?> name=d_localext size="40"></TD>
    <TD width="15%">本地限制：</TD>
    <TD width="35%"><INPUT class=input title=数字型，单位KB value=<?php   echo $Mystyle[$id][0][39];?> name=d_localsize>KB</TD></TR>
  <TR>
    <TD colSpan=4><font color=red>&nbsp;&nbsp;&nbsp;缩略图及水印相关设置：</font></TD></TR>
  <TR>
    <TD width="15%">图形处理组件：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sltsyobject>
	<OPTION value=0<?php   if ($Mystyle[$id][0][40]=="0")
  {
?> selected<?php   } ?>>PHP GD2图形库</OPTION>
	</SELECT></TD>
    <TD width="15%">处理图形扩展名：</TD>
    <TD width="35%"><INPUT class=input value=<?php   echo $Mystyle[$id][0][41];?> name=d_sltsyext></TD></TR>
  <TR>
    <TD width="15%">缩略图使用状态：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sltflag>
	<OPTION value=1<?php   if ($Mystyle[$id][0][42]=="1")
  {
?> selected<?php   } ?>>使用</OPTION>
	<OPTION value=0<?php   if ($Mystyle[$id][0][42]=="0")
  {
?> selected<?php   } ?>>不使用</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][42]=="2")
  {
?> selected<?php   } ?>>前台用户控制</OPTION>
	</SELECT></TD>
    <TD width="15%">缩略图长度条件：</TD>
    <TD width="35%"><INPUT class=input title=图形的长度只有达到此最小长度要求时才会生成缩略图，数字型 
      value="<?php   echo $Mystyle[$id][0][43];?>" name=d_sltminsize>px</TD></TR>
  <TR>
    <TD width="15%">缩略图生成长度：</TD>
    <TD width="35%"><INPUT class=input title=生成的缩略图长度值，数字型 value="<?php   echo $Mystyle[$id][0][44];?>" 
      name=d_sltoksize>px</TD>
    <TD width="15%">&nbsp;</TD>
    <TD width="35%">&nbsp;</TD></TR>
  <TR>
    <TD width="15%">文字水印使用状态：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sywzflag>
	<OPTION value=0<?php   if ($Mystyle[$id][0][45]=="0")
  {
?> selected<?php   } ?>>不使用</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][45]=="1")
  {
?> selected<?php   } ?>>使用</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][45]=="2")
  {
?> selected<?php   } ?>>前台用户控制</OPTION>
	</SELECT></TD>
    <TD width="15%">文字水印启用条件：</TD>
    <TD width="35%">宽:<INPUT class=input title=图形的宽度只有达到此最小宽度要求时才会生成水印，数字型 
      size=4 value="<?php   echo $Mystyle[$id][0][46];?>" name=d_sywzminwidth>px&nbsp; 高:<INPUT class=input 
      title=图形的高度只有达到此最小高度要求时才会生成水印，数字型 size=4 value="<?php   echo $Mystyle[$id][0][47];?>" 
    name=d_sywzminheight>px</TD></TR>
  <TR>
    <TD width="15%">文字水印内容：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时的文字内容 value="<?php   echo htmlspecialchars($Mystyle[$id][0][48]);?>"  
      name=d_sytext></TD>
    <TD width="15%">文字水印字体颜色：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的颜色 value="<?php   echo $Mystyle[$id][0][49];?>" 
      name=d_syfontcolor></TD></TR>
  <TR>
    <TD width="15%">文字水印阴影颜色：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时的文字阴影颜色 value="<?php   echo $Mystyle[$id][0][50];?>"
      name=d_syshadowcolor></TD>
    <TD width="15%">文字水印阴影大小：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的阴影大小 value="<?php   echo $Mystyle[$id][0][51];?>" 
      name=d_syshadowoffset>px</TD></TR>
  <TR>
    <TD width="15%">文字水印字体大小：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的字体大小 value="<?php   echo $Mystyle[$id][0][52];?>"  
      name=d_syfontsize>px</TD>
    <TD width="15%">中文字体库及路径：</TD>
    <TD width="35%"><INPUT class=input title=当使用文字水印时文字的字体名 value="<?php   echo htmlspecialchars($Mystyle[$id][0][53]);?>"  
      name=d_syfontname size=30>&nbsp;&nbsp;<a href="#baseurl2">说明</a></TD></TR>
  <TR>
    <TD width="15%">文字水印位置：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sywzposition>
	<OPTION value=1<?php   if ($Mystyle[$id][0][54]=="1")
  {
?> selected<?php   } ?>>左上</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][54]=="2")
  {
?> selected<?php   } ?>>左中</OPTION>
	<OPTION value=3<?php   if ($Mystyle[$id][0][54]=="3")
  {
?> selected<?php   } ?>>左下</OPTION>
	<OPTION value=4<?php   if ($Mystyle[$id][0][54]=="4")
  {
?> selected<?php   } ?>>中上</OPTION>
	<OPTION value=5<?php   if ($Mystyle[$id][0][54]=="5")
  {
?> selected<?php   } ?>>中中</OPTION>
	<OPTION value=6<?php   if ($Mystyle[$id][0][54]=="6")
  {
?> selected<?php   } ?>>中下</OPTION>
	<OPTION value=7<?php   if ($Mystyle[$id][0][54]=="7")
  {
?> selected<?php   } ?>>右上</OPTION>
	<OPTION value=8<?php   if ($Mystyle[$id][0][54]=="8")
  {
?> selected<?php   } ?>>右中</OPTION>
	<OPTION value=9<?php   if ($Mystyle[$id][0][54]=="9")
  {
?> selected<?php   } ?>>右下</OPTION>
	</SELECT></TD>
    <TD width="15%">文字水印边距：</TD>
    <TD width="35%">左右:<INPUT class=input title=居左时作用为左边距，居右时作用为右边距，数字型 size=4 
      value="<?php   echo $Mystyle[$id][0][55];?>" name=d_sywzpaddingh>px&nbsp; 上下:<INPUT class=input 
      title=居上时作用为上边距，居下时作用为下边柜，数字型 size=4 value="<?php   echo $Mystyle[$id][0][56];?>" name=d_sywzpaddingv>px</TD></TR>
  <TR>
    <TD width="15%">文字水印文字占位：</TD>
    <TD width="35%">宽:<INPUT class=input title=水印文字的占位宽度，由字数、字体大小等设置的效果确定，数字型 
      size=4 value="<?php   echo $Mystyle[$id][0][57];?>" name=d_sywztextwidth>px&nbsp; 高:<INPUT class=input 
      title=水印文字的占位高度，由字数、字体大小等设置的效果确定，数字型 size=4 value="<?php   echo $Mystyle[$id][0][58];?>" 
      name=d_sywztextheight>px&nbsp; <INPUT onclick=doCheckWH(1) type=button value=检测宽高></TD>
    <TD width="15%"></TD>
    <TD width="35%"></TD></TR>
  <TR>
    <TD width="15%">图片水印使用状态：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sytpflag>
	<OPTION value=0<?php   if ($Mystyle[$id][0][59]=="0")
  {
?> selected<?php   } ?>>不使用</OPTION>
	<OPTION value=1<?php   if ($Mystyle[$id][0][59]=="1")
  {
?> selected<?php   } ?>>使用</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][59]=="2")
  {
?> selected<?php   } ?>>前台用户控制</OPTION>
	</SELECT></TD>
    <TD width="15%">图片水印启用条件：</TD>
    <TD width="35%">宽:<INPUT class=input title=图形的宽度只有达到此最小宽度要求时才会生成水印，数字型 
      size=4 value="<?php   echo $Mystyle[$id][0][60];?>" name=d_sytpminwidth>px&nbsp; 高:<INPUT class=input 
      title=图形的高度只有达到此最小高度要求时才会生成水印，数字型 size=4 value="<?php   echo $Mystyle[$id][0][61];?>" 
    name=d_sytpminheight>px</TD></TR>
  <TR>
    <TD width="15%">图片水印位置：</TD>
    <TD width="35%">
	<SELECT size=1 name=d_sytpposition>
	<OPTION value=1<?php   if ($Mystyle[$id][0][62]=="1")
  {
?> selected<?php   } ?>>左上</OPTION>
	<OPTION value=2<?php   if ($Mystyle[$id][0][62]=="2")
  {
?> selected<?php   } ?>>左中</OPTION>
	<OPTION value=3<?php   if ($Mystyle[$id][0][62]=="3")
  {
?> selected<?php   } ?>>左下</OPTION>
	<OPTION value=4<?php   if ($Mystyle[$id][0][62]=="4")
  {
?> selected<?php   } ?>>中上</OPTION>
	<OPTION value=5<?php   if ($Mystyle[$id][0][62]=="5")
  {
?> selected<?php   } ?>>中中</OPTION>
	<OPTION value=6<?php   if ($Mystyle[$id][0][62]=="6")
  {
?> selected<?php   } ?>>中下</OPTION>
	<OPTION value=7<?php   if ($Mystyle[$id][0][62]=="7")
  {
?> selected<?php   } ?>>右上</OPTION>
	<OPTION value=8<?php   if ($Mystyle[$id][0][62]=="8")
  {
?> selected<?php   } ?>>右中</OPTION>
	<OPTION value=9<?php   if ($Mystyle[$id][0][62]=="9")
  {
?> selected<?php   } ?>>右下</OPTION>
	</SELECT></TD>
    <TD width="15%">图片水印边距：</TD>
    <TD width="35%">左右:<INPUT class=input title=居左时作用为左边距，居右时作用为右边距，数字型 size=4 
      value="<?php   echo $Mystyle[$id][0][63];?>"  name=d_sytppaddingh>px&nbsp; 上下:<INPUT class=input 
      title=居上时作用为上边距，居下时作用为下边柜，数字型 size=4 value="<?php   echo $Mystyle[$id][0][64];?>"  name=d_sytppaddingv>px</TD></TR>
  <TR>
    <TD width="15%">图片水印图片路径：</TD>
    <TD width="35%"><INPUT class=input title=当使用图片水印时图片的路径 
name=d_sypicpath value="<?php   echo $Mystyle[$id][0][65];?>"></TD>
    <TD width="15%">图片水印透明度：</TD>
    <TD width="35%"><INPUT class=input title=0至1间的数字，如0.5表示半透明 value="<?php   echo $Mystyle[$id][0][66];?>" 
      name=d_sytpopacity></TD></TR>
  <TR>
    <TD width="15%">图片水印图片占位：</TD>
    <TD width="35%">宽:<INPUT class=input title=水印图片的宽度，数字型 size=4 value="<?php   echo $Mystyle[$id][0][67];?>" 
      name=d_sytpimagewidth>px&nbsp; 高:<INPUT class=input title=水印图片的高度，数字型 
      size=4 value="<?php   echo $Mystyle[$id][0][68];?>" name=d_sytpimageheight>px&nbsp; <INPUT onclick=doCheckWH(2) type=button value=检测宽高></TD>
    <TD width="15%"></TD>
    <TD width="35%"></TD></TR>
  <TR>
    <TD width="15%">水印宽高检测区：</TD>
    <TD width="85%" colSpan=3><SPAN id=tdPreview></SPAN></TD></TR>
  <TR>
    <TD align=middle colSpan=4><INPUT type=submit align=absMiddle value="  <?php   if ($sAction=="copy")
  {
?>复制新建<?php   }
    else
  {
?>修改<?php   } ?>  ">&nbsp;<INPUT type=reset value="  重填  " name=btnReset></TD></TR></FORM></TBODY></TABLE>
</div>
<div class="div3">
	<a name=baseurl>路径模式设置说明：</a>
	<ul type=square>
	<li>相对路径：指所有的相关上传或自动插入文件路径，编辑后都以"UploadFile/..."或"../UploadFile/..."形式呈现，当使用此模式时，显示路径和内容路径必填，显示路径必须以"/"开头和结尾，内容路径设置中不能以"/"开头。
	<li>绝对根路径：指所有的相关上传或自动插入文件路径，编辑后都以"/eWebEditor/UploadFile/..."这种形式呈现，当使用此模式时，显示路径和内容路径不必填。
	<li>绝对全路径：指所有的相关上传或自动插入文件路径，编辑后都以"http://xxx.xxx.xxx/eWebEditor/UploadFile/..."这种形式呈现，当使用此模式时，显示路径和内容路径不必填。
	<li>站外绝对全路径：当使用此模式时，上传路径必须是实际物理路径，如："c:\xxx\"；显示路径为空；内容路径必须以"http"开头。
	</ul>

	<a name=baseurl2><font color=blue><b>中文字体库及路径：</b></font></a>
	<ul type=square>
	<li><font color=red><b>PHP很讨厌，非得指向具体的字库。否则，文字水印中的中文（全角字符）会乱码。如果服务器系统字体不可用，可把字体文件上传至WEB目录。</b></font>
	</ul>
</div>
</div>
</body>
</html>
<?php 

} 

function styletop(){

?>
<div class="div2">
[<A href="<?php   echo PhilSName();?>?action=style">所有样式列表</A>]&nbsp;&nbsp;&nbsp;&nbsp;
[<A href="<?php   echo PhilSName();?>?action=d_styleadd">新建一样式</A>]&nbsp;&nbsp;&nbsp;&nbsp;
[<A onclick="history.back();return false;" href="<?php   echo PhilSName();?>?action=style">返回前一页</A>]
</div>
<?php 
} 

function PhilMenu(){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
   body {font-size:12px;background:#9DBCEA;text-align:center;padding-left:10px;padding-right:10px;}
   ul {margin:0px;}
   li {padding-top:8px;}
   a {color:#666666;text-decoration:none;}
   a:hover {color:#dd0000;text-decoration:none;}
   .fdt1 {width:100%;height:100%;FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); }
</style>
<base target="main">
</head>
<body>
		<fieldset class="fdt1">
		<legend>MENU</legend>
		<ul>
         <li><A href="<?php   echo PhilSName();?>?action=style" target="main">样式管理</A></li>
         <li><A href="<?php   echo PhilSName();?>?action=d_upload" target="main">上传管理</A></li>
         <li><A href="<?php   echo PhilSName();?>?action=main" target="main">后台首页</A></li>
         <li><A href="<?php   echo PhilSName();?>?action=logout" target="main" onclick="return confirm('提示：您确定要退出系统吗？')">退出登录</A></li>
         <li style="list-style:none;">------------</li>
<!--		 <li style="list-style:square;"><A href="--><?php //  echo PhilSName();?><!--?action=PhilChang" target="main">关于张宇</A></li>-->
<!--		 <li style="list-style:square;"><A href="http://www.zhyu.net/bbs/" target="_blank">宇式情歌</A></li>-->
		</ul>
		 <p>&nbsp;</p>
		 <p>&nbsp;</p>
		 <p>&nbsp;</p>
		</fieldset>
</body>
</html>
<?php 
} 
?>

<?php 
function d_upload(){

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:12px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 15px 5px 15px;
		background:#efefef;
		color:red;
		text-align:right;
}  
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:center;
		margin-top:10px;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;text-align:center;}
.div5 {width:100%;}
TABLE {BORDER-RIGHT: 0px; PADDING-RIGHT: 2px; BORDER-TOP: 0px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 2px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;}
TABLE.List TH {COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1}
TABLE.List TD {PADDING: 1px 5px 1px 5px; LINE-HEIGHT: 18px; BACKGROUND-COLOR: #d6dff7;}
TABLE.pic TD {PADDING: 1px 1px 1px 1px; LINE-HEIGHT: 18px; BACKGROUND-COLOR: #d6dff7; text-align:center;}
A:link {COLOR: #333333; TEXT-DECORATION: underline;}
A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
input,select {	BORDER-TOP-WIDTH: 1px; PADDING-RIGHT: 1px; PADDING-LEFT: 1px; BORDER-LEFT-WIDTH: 1px; BORDER-LEFT-COLOR: #cccccc; BORDER-BOTTOM-WIDTH: 1px; BORDER-BOTTOM-COLOR: #cccccc; PADDING-BOTTOM: 1px; BORDER-TOP-COLOR: #cccccc; PADDING-TOP: 1px; HEIGHT: 18px; BORDER-RIGHT-WIDTH: 1px; BORDER-RIGHT-COLOR: #cccccc;font-size:9pt;}
.pic2 {width:180px;height:125px;text-align:center;margin:5px 5px 5px 5px;border:1px #666666 solid;cursor:hand;}
.picmode {float:left;border:1px #666666 solid;width:180px;margin: 3px 3px 3px 3px;}
.page {width:100%;height:25px;text-align:center;line-height:25px;border:2px #ffffff solid;margin:10px 8px 10px 8px;}
.folder {FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#FEFE9E, EndColorStr=#FFD773);}
.media {FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#F2F8FF, EndColorStr=#6994CD);}
.real {FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#F2F8FF, EndColorStr=#53A500);}
</style>
<script language="JScript">
function ResetcUp(s){
    var t, num, temp;
	if (s==upform.fUpdir.value)
	{   
	    temp = "";
	    return temp;
	}
    t = s.split("/");
	temp = "";
	num = t.length;
	for (var i=0;i<num-2 ;i++ )
	{
	    temp += t[i] + "/";
	}

    return temp;
}

function previewmedia(url,mode){
    window.open("<?php   echo $GLOBALS["EditorBasePath"];?>dialog/previewmedia.htm?url="+url+"&mode="+mode,"","width=400,height=350,left="+(screen.width-400)/2+",top="+(screen.height-350)/2);  
}
function ffselect(o,m){
	var ff = document.getElementById("upform").getElementsByTagName("INPUT");
	var cnt = ff.length;
	for (var i=0; i<=cnt-1; i++){
		if (ff[i].type=='checkbox'){
			if(m==1){
				ff[i].checked = true;
			}else{

				if (ff[i].checked){
					ff[i].checked = false;
				}else{
					ff[i].checked = true;
				}
			}
		}
	}
}
</script>
</head>
<body>
<?php 

	$updir=TrimPost("updir");
	$FileDir = "";
	$cUpdir = "";

	if(!check_urlcome()) $updir = "";

	if ($updir!=""){
		$cUpdir_tmp=explode("|",$updir);
		if (count($cUpdir_tmp)<2){
			$updir = "";
		}else{
			$id = getIdByStyleName($cUpdir_tmp[1],$GLOBALS["Mystyle"]);
			if($id<0){
				$updir = "";
			}else if($GLOBALS["Mystyle"][$id][0][25]!=$cUpdir_tmp[0]){
				$updir = "";
			}
		}
	}

	if ($updir!=""){
		if (TrimPost("cUpdir")==""){
		  $cUpdir = $cUpdir_tmp[0];
		}else{
		  $cUpdir=TrimPost("cUpdir");
		} 
		$FileDir=$GLOBALS["EditorBasePath"].$cUpdir;

		$mode=TrimPost("mode");
		if ($mode!=""){
			$MaxPerPage_tmp = explode("|",$mode);
			$MaxPerPage=intval($MaxPerPage_tmp[1]);
			$sMode_tmp=explode("|",$mode);
			$sMode="0|".$sMode_tmp[0];
		} 

		//删除文件/文件夹;
		if(isset($_POST["ff"])){
			$errnum = 0;
			$delbox=$_POST["ff"];
			for ($i=0; $i<count($delbox);$i++){
				$errnum += DeleteAFile(iconv('UTF-8','GB2312',$FileDir.$delbox[$i]));
			}
		}
	} 

?>
<DIV CLASS="main">
<form id=upform name=upform action="?action=d_upload" method=post>
<div class="div1">当前位置：上传管理</div>
<div class="div2">
    <div style="float:left;padding-top:5px;">
    当前目录：<?php   echo $cUpdir;?> 

	</div><input type=hidden name=cUpdir value="<?php   echo $cUpdir;?>"><input type=hidden name=fUpdir value="<?php   if ($updir!="")
  {
	$updir_temp = explode("|",$updir);
    echo $updir_temp[0];
  } ?>">
	<div style="float:right;"><input type=button value="上级目录" onclick="upform.cUpdir.value=ResetcUp(upform.cUpdir.value);upform.submit()">　

    <select name=mode onchange="upform.submit()">
	   <option value="0|0"<?php   if ($mode=="0|0")
  {
?> selected<?php   } ?>>列表模式（全部）</option>
	   <option value="0|12"<?php   if ($mode=="0|12")
  {
?> selected<?php   } ?>>列表模式（12）</option>
	   <option value="0|24"<?php   if ($mode=="0|24")
  {
?> selected<?php   } ?>>列表模式（24）</option>
	   <option value="0|48"<?php   if ($mode=="0|48")
  {
?> selected<?php   } ?>>列表模式（48）</option>
       <option value="1|0"<?php   if ($mode=="1|0")
  {
?> selected<?php   } ?>>预览模式（全部）</option>
       <option value="1|12"<?php   if ($mode=="1|12")
  {
?> selected<?php   } ?>>预览模式（12）</option>
       <option value="1|24"<?php   if ($mode=="1|24")
  {
?> selected<?php   } ?>>预览模式（24）</option>
       <option value="1|48"<?php   if ($mode=="1|48")
  {
?> selected<?php   } ?>>预览模式（48）</option>
	</select>

    <select name=updir onchange="upform.cUpdir.value='';upform.submit()">
       <option value="">请选择样式目录...</option>
	   <?php 
  $temp_arry=$GLOBALS["Mystyle"];
  for ($j=0; $j<count($temp_arry); $j++){
?>
	   <option value="<?php     echo $temp_arry[$j][0][25];?>|<?php     echo $temp_arry[$j][0][0];?>"<?php     if ($updir==$temp_arry[$j][0][25]."|".$temp_arry[$j][0][0])
    {
?> selected<?php     } ?>>- 样式：<?php     echo $temp_arry[$j][0][0];?> -目录：<?php     echo $temp_arry[$j][0][25];?></option>
	   <?php 

  }

?>
	</select>
	</div>
</div>
<div class="div4">
<?php 
  if ($updir!="")
  {
	$mode_arr = explode("|",$mode);
    if ($mode_arr[0]=="0")
    {

?>
<TABLE class=list cellSpacing=1 cellPadding=0 align=center border=0>
  <TBODY>
  <tr align=center><th width='10%'>类型</th><th width='40%'>文件(夹)名</th><th width='10%'>大小</th><th width='15%'>上传日期</th><th width='15%'>最后访问</th><th width='10%'>删除</th></tr>
  <?php GetFFList(iconv('UTF-8','GB2312',$FileDir),iconv('UTF-8','GB2312',$cUpdir),$MaxPerPage,TrimPost("page"),$sMode);?>
 </TBODY>
</TABLE>
<?php     }
      else
    {
?>
  <div class="div5"><?php GetFFList(iconv('UTF-8','GB2312',$FileDir),iconv('UTF-8','GB2312',$cUpdir),$MaxPerPage,TrimPost("page"),$sMode);?></div>
<?php 
    } 

  } 

?>
</div>
<div class="div3" style="display: none"><a href="http://www.calmasp.com/" target="_blank">三刀网</a> ==　 担担钩　 == 　QQ:119110112　 == 　lwlwei@126.com </div>
</form>
</div>
</body>
</html>

<?php 
	if($errnum>0){
		echo "<script>alert('有 $errnum 个文件(夹),因为权限不足,删除失败!!!');</script>";
	}

} 

function PhilMain(){

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:12px 10px 8px 15px;
}
.div2 {
        width:100%;
		height:20px;
		BORDER: 1px #ffffff solid; 
		padding:6px 0 5px 0;
		background:#efefef;
		color:red;
}  
.div3 {
        width:100%;
		height:15px;
		BORDER: 1px #ffffff solid; 
		padding:10px 10px 8px 15px;
		background:#efefef;
		text-align:center;
		margin-top:10px;
}
.div4 {width:100%;BORDER: 1px #ffffff solid;margin-top:10px;}
TABLE.List {
	BORDER-RIGHT: 0px; PADDING-RIGHT: 2px; BORDER-TOP: 0px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; BORDER-LEFT: 0px; WIDTH: 100%; PADDING-TOP: 2px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #ffffff;font-size:12px;
}
TABLE.List TH {
	COLOR: #ffffff; HEIGHT: 24px; BACKGROUND-COLOR: #799ae1
}
TABLE.List TD {
	PADDING-LEFT: 10px; LINE-HEIGHT: 18px; BACKGROUND-COLOR: #d6dff7
}
 A:link {COLOR: #333333; TEXT-DECORATION: underline;}
 A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
 A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
.red {color:red;font-family:宋体;}
.green {color:green;font-family:宋体;}
</style>
</head>
<body>
<DIV CLASS="main">
<div class="div1">当前位置：后台首页</div>

<div class="div2">
本程序代码，须满足以下组件支持，才能安全、稳定、完整运行。
</div>
<div class="div4">
<?php 
function showResult($v){
	if($v==1){
		echo'<font class=green><b>√</b></font>&nbsp;支持';
	}else{
		echo'<font class=red><b>×</b></font>&nbsp;不支持';
	}
}
?>
<TABLE class=list cellSpacing=1 cellPadding=0 align=center border=0>
  <FORM name=myform action=?action=del method=post>
  <TBODY>
  <TR align=middle>
    <TH align=center colspan=2>服务器的相关参数</TH>
    <TH align=center colspan=2>组件支持相关参数</TH></tr>

	<tr>
		<td width="15%">服务器名：</td>
		<td width="45%"><?php echo $_SERVER["SERVER_NAME"]?></td>
		<td width="20%">mysql数据库：</td>
		<td width="20%"><?php echo showResult(function_exists("mysql_close"))?></td>
	</tr>
	<tr>
		<td width="15%">服务器IP：</td>
		<td width="45%"><?php echo $_SERVER["LOCAL_ADDR"]?></td>
		<td width="20%">odbc数据库：</td>
		<td width="20%"><?php echo showResult(function_exists("odbc_close"))?></td>
	</tr>
	<tr>
		<td width="15%">服务器端口：</td>
		<td width="45%"><?php echo $_SERVER["SERVER_PORT"]?></td>
		<td width="20%"> SQL Server数据库：</td>
		<td width="20%"><?php echo showResult(function_exists("mssql_close"))?></td>
	</tr>
	<tr>
		<td width="15%">服务器时间：</td>
		<td width="45%"><?php echo date("Y年m月d日H点i分s秒")?></td>
		<td width="20%">msql数据库：</td>
		<td width="20%"><?php echo showResult(function_exists("msql_close"))?></td>
	</tr>
	<tr>
		<td width="15%">PHP版本：</td>
		<td width="45%"><?php echo PHP_VERSION?></td>
		<td width="20%">SMTP：</td>
		<td width="20%"><?php echo showResult(get_magic_quotes_gpc("smtp"))?></td>
	</tr>
	<tr>
		<td width="15%">WEB服务器版本：</td>
		<td width="45%"><?php echo $_SERVER["SERVER_SOFTWARE"]?></td>
		<td width="20%">图形处理 GD Library：</td>
		<td width="20%"><?php echo showResult(function_exists("imageline"))?></td>
	</tr>

	<tr>
		<td width="15%">服务器操作系统：</td>
		<td width="45%"><?php echo PHP_OS?></td>
		<td width="20%">XML：</td>
		<td width="20%"><?php echo showResult(get_magic_quotes_gpc("XML Support"))?></td>
	</tr>
	<tr>
		<td width="15%">脚本超时时间：</td>
		<td width="45%"><?php echo get_cfg_var("max_execution_time")?> 秒</td>
		<td width="20%">FTP：</td>
		<td width="20%"><?php echo showResult(get_magic_quotes_gpc("FTP support"))?></td>
	</tr>
	<tr>
		<td width="15%">站点物理路径：</td>
		<td width="45%"><?php echo realpath("../")?></td>
		<td width="20%">Sendmail：</td>
		<td width="20%"><?php echo showResult(get_magic_quotes_gpc("Internal Sendmail Support for Windows 4"))?></td>
	</tr>
	<tr>
		<td width="15%">脚本上传文件大小限制：</td>
		<td width="45%"><?php echo get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件"?></td>
		<td width="20%">显示错误信息：</td>
		<td width="20%"><?php echo showResult(get_cfg_var("display_errors"))?></td>
	</tr>
	<tr>
		<td width="15%">POST提交内容限制：</td>
		<td width="45%"><?php echo get_cfg_var("post_max_size")?></td>
		<td width="20%">使用URL打开文件：</td>
		<td width="20%"><?php echo showResult(get_cfg_var("allow_url_fopen"))?></td>
	</tr>
	<tr>
		<td width="15%">服务器语种：</td>
		<td width="45%"><?php echo getenv("HTTP_ACCEPT_LANGUAGE")?></td>
		<td width="20%">压缩文件支持(Zlib)：</td>
		<td width="20%"><?php echo showResult(function_exists("gzclose"))?></td>
	</tr>
	<tr>
		<td width="15%">脚本运行时可占最大内存：</td>
		<td width="45%"><?php echo get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无"?></td>
		<td width="20%">ZEND支持(1.3.0)：</td>
		<td width="20%"><?php echo showResult(function_exists("zend_version"))?></td>
	</tr>	
  <TR>
    <TD colspan=4>
	   <ul type=square style="display: none">
          <li style="padding:10 0 0 0;">本程序未加密，源码公开，转载请尽量对俺们家【老张】手下留情; 若个人使用实在不爽，那就自己改改吧。</li>
		  <li>本程序从严格意义上来讲，已经算是侵权，强烈建议偷偷地用；若有人想用于商业用途，那我也摸什么没办法。</li>
		  <li>本程序可放在任意目录下使用，文件名可修改；使用前，请先修改用户名密码，并配置好相关参数即可。</li>
		  <li>本程序采用PHP5开发，支持PHP自身上传功能；其它版本（ASP，.NET，JSP）或上传组件也比较容易开发。</li>
		  <li>本程序使用前，请先打开相关文件夹的写权限，否则可能会出现写入失败的错误。</li>
		  <li>本程序从开发到最终完成，反复数次，也算是沥尽心血；仅仅是这一点东西尚且如此，可见整个eWebEditor更是宁聚了N多程序员的精力和汗水；大家如果以后发达了，别忘了支持一下原版。</li>
		  <li>开发环境：Window server 2003 + IIS 6.0 + PHP5; 本程序本人未添加任何恶意代码，也未进行过杀软测试。 </li>
		  <li>最后，替【老张】做下广告，「无论狂风暴雨，情歌只听张宇!」其实这并不只是一句无知的口号，在我人生最艰难的阶段，正是他陪俺度过了那段暗无天日的生活。<br>
		  这一生只钟情于两个歌手：张博翔，张国荣；在我眼里，他们俩个，一放一收，共同创造了张弛有道的流行乐坛，在很多人心里都留下了永久的回忆。<br>
		  因为哥哥已去，而且又比大叔红一些，所以这里就主推大叔张宇了。希望得到大家滴支持。谢谢。</li>
	   </ul>
	</TD>
   </TR>
</TBODY>
</TABLE>
</div>
<div class="div3"><a href="http://www.calmasp.com/" target="_blank">三刀网</a> ==　 担担钩　 == 　QQ:119110112　 == 　lwlwei@126.com </div>
</div>
</body>
</html>

<?php 
} 

function PhilTop(){

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
body {margin:0px;padding:0px;height:40px;background:#9DBCEA;text-align:center;}
.div1 {
        width:100%;
		height:90%;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER-LEFT: 0px #002D96 solid; 
		padding:10px 0 0 0;
		font-size:14px;
		font-weight:bolder;
		color:#6666ff;
}
</style>
</head>
<body>
<div class="div1" style="display: none">「无论狂风暴雨，情歌只听张宇!」「http://www.zhyu.net/bbs/」「http://tieba.baidu.com/f?kw=张宇」</div>
</body>
</html>
<?php 
} 

function PhilChang(){

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>
<style>
body {margin:0 0 0 0;padding:0 0 0 0;width:100%;height:100%;background:#d6dff7;text-align:center;font-size:12px;}
.main {width:100%;height:100%;overflow-y:auto;padding:10px 10px 10px 10px;}
.div1 {
        width:100%;
		height:20px;
		FILTER: progid:DXImageTransform.Microsoft.Gradient(GradientType=0, StartColorStr=#9DBCEA, EndColorStr=#ffffff); 
		BORDER: 1px #ffffff solid; 
		text-align:left;
		padding:12px 10px 8px 15px;
}

.div4 {width:100%;BORDER: 2px #ffffff solid;margin-top:0px;text-align:left;background-color:#f0f0f0;}
 A:link {COLOR: #333333; TEXT-DECORATION: underline;}
 A:visited {COLOR: #333333; TEXT-DECORATION: underline;}
 A:hover {COLOR: #ff0000; TEXT-DECORATION: underline;}
</style>
</head>
<body>
<DIV CLASS="main">
<div class="div1">当前位置：关于张宇</div>
<div class="div4">
<ul type=square>
<li style="padding:10 0 0 0;">+歌手生涯：--------------------------------------------------
<ul>
	 <li style="list-style:none;padding:10 0 10 0;">/--大滚制作，歌林发行--/

	 <li>1993年 04月01日  「走路有风」
	 <li>1993年 11月26日  「用心良苦」
	 <li>1994年 06月20日  「温故知心」

	 <li style="list-style:none;padding:10 0 10 0;">/--喜得制作，百代发行--/

	 <li>1995年 06月26日  「一言难尽」
	 <li>1996年 04月　　 「消息」
	 <li>1997年　　　　　「整个八月」
	 <li>1997年 11月03日  「温古知新」「一个人的天荒地老」 
	 <li>1998年 11月　　 「单恋」EP
	 <li>1998年 12月　　 「月亮太阳」
	 <li>1999年 08月09日  「雨一直下」
	 <li>2000年 04月22日  「奇迹创世纪精选」 
	 <li>2001年 07月26日  「替身」
	 <li>2003年 02月26日  「大丈夫」
	 <li>2004年 03月19日  「不甘寂寞」
	 <li>2005年 03月11日  「男人的好」(新歌+精选)影音全记录

     <li>2007年　　　　　「------------」由于种种原因未发行

	 <li style="list-style:none;padding:10 0 10 0;">/--喜得音乐，制作发行--/
	 <li>2008年　　　　　「欢喜来逗阵」(片头曲：可爱的查某 片尾曲：伞下)
     <li>2009年　　　　　「魔女18号电视原声带」(片头曲：侠侣神雕 片尾曲：置身事外)

     <li>2009年　　　　　「Back to 张宇」EP

     </ul>

 <li style="padding:10 0 0 0;">+主持生涯：--------------------------------------------------
     <ul>
	 <li style="padding:10 0 0 0;">2004年  张宇vs张小燕  「快乐星期天」                        
	 <li>2005年  张宇vs扬扬　 「超级星期舞」[上海星空卫视]         
	 <li>2007年  张宇vs曾国城  「男人坏坏Why」                       
	 <li>2007~2008年 陶子　　「超级星空大道」固定评审[台湾中视]
	 <li>2008年  张宇vs王惠    　「综艺大满贯」[湖北卫视]
     </ul>

 <li style="padding:10 0 10 0;">+演艺生涯：--------------------------------------------------
     <ul>
	 <li style="padding:10 0 0 0;">2002年  「爱情白皮书」  客串
	 <li>2005年  「大熊医师家」  客串
	 <li>2008年  「欢喜来逗阵」  男主角
     </ul>
</ul>
</div>
</div>
</body>
</html>
<?php 
} 

?>
<?php 
function PhilIndex(){
?>
<html>
<head>
<title>eWebEditor V5.5 简体中文伞下版(PHP)</title>

<script language="JavaScript">
window.self.focus();
</script>
</head>
<frameset rows="40,*" framespacing="0" border="0" frameborder="0">
  <frame name="top" src="<?php   echo PhilSName();?>?action=top" scrolling="no">
<frameset cols="155,*" framespacing="0" border="0" frameborder="0">
  <frame name="menu" src="<?php   echo PhilSName();?>?action=menu" scrolling="no">
  <frame name="main" src="<?php   echo PhilSName();?>?action=main" scrolling="no">
</frameset>
  <noframes>
    <body topmargin="0" leftmargin="0">
    <p>此网页使用了框架，但您的浏览器不支持框架</p>
    </body>
  </noframes>
</frameset>
</html>
<?php
} 

function PhilLogin(){

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
</head>
<body scroll=no style="background:#d5d5d5;">
<div style="font-size:14px;font-family:宋体;text-align:center;width:500px;line-height:20px;margin:auto;">
【eWebEditor V5.5 简体中文·伞下版(PHP)】<br>www.calmasp.com
</div>
<div style="font-size:12px;font-family:宋体;width:480px;border:1px dotted #888888;padding:10px 10px 10px 10px;margin:auto;">

		<table border=0 align=center>
		<tr><td>
				<fieldset style="width:280px;height:120px;padding-left:10px;">
				<legend>《登录》</legend>
				<table>
				<form action="<?php   echo PhilSName();?>" method="post">
				<input type=hidden name="action" value="login">
				 <tr><td height=30>登录名称：<input type=text name="uid"></td></tr>
				 <tr><td>登录密码：<input type=password name="pwd"></td></tr>
				 <tr><td height=30 align=right><input type=submit value="《登录》"></td></tr>
				 </form>
				 </table>
				</fieldset>
			</td>
			<td rowspan=2>
					<fieldset style="width:160px;height:289px;padding-left:10px;line-height:16px;">
					<legend>《伞下》</legend>
					<br>
					我们在伞下<br>
					如此执着凝望<br>
					爱与割舍<br>
					来回碰撞<br>
					想牵手<br>
					走不同的方向<br>
					是捆绑<br><br>

					我们在伞下<br>
					准备失去对方<br>
					带着了解<br>
					微笑和泪光<br>
					我会祝福你<br>
					伞外的世界<br>
					是一片蔚蓝<br>
					</fieldset>
			</td>
		</tr>
		<tr><td>

		<fieldset style="width:280px;height:148px;padding-left:10px;line-height:14px;">
		<legend>《声明》</legend>
		<ol>
		   <li>本程序设计语言:PHP5</li>
		   <li>在伞下版(ASP)的基础上改成了PHP版</li>
		   <li>本程序(仅指本页)源代码归本人所有</li>
		   <li>本程序允许被转载修改</li>
		   <li>本人不对本程序的安全性负责</li>
		   <li>本人不提供任何有关更新与支持</li>
		   <li>本程序只限于程序爱好者学习研究之用</li>
        </ol>
		</fieldset>
		</td></tr></table>


</div>
</body>
</html>
<?php
}

function getDirSize($dir){ 
	$handle = opendir($dir);
	$sizeResult = 0;
	while (false!==($FolderOrFile = readdir($handle))){ 
		if($FolderOrFile != "." && $FolderOrFile != ".."){ 
			if(is_dir("$dir/$FolderOrFile")){ 
				$sizeResult += getDirSize("$dir/$FolderOrFile"); 
			}
			else{ 
				$sizeResult += filesize("$dir/$FolderOrFile"); 
			}
		}    
	}
	closedir($handle);
	return $sizeResult;
}

function GetSizeUnit($n_Size){
	if ($n_Size >= 1024*1024*1024){
		return number_format(($n_Size / 1024 / 1024 / 1024), 2, ".", "") . "GB";
	}else if ($n_Size >= 1024*1024){
		return number_format(($n_Size / 1024 / 1024), 2, ".", "") . "MB";
	}else{
		return number_format(($n_Size / 1024), 2, ".", "") . "KB";
	}
}

function GetFFList($path,$cup,$MaxPerPage,$page,$mode){
	$mode=explode("|",$mode);
	$MaxPerPage=intval($MaxPerPage);

	if (!is_dir($path)){
		echo "Folder Not Exists";
		return;
	} 

	$temp = array();

	if ($handle = opendir($path)){
		while (false !== ($file = readdir($handle))){
			$sFileType = filetype($path.$file);
			if ($sFileType == "dir"){
				if (($file != ".") && ($file != "..")){
					$oDirs[] = $file;

				}
			}else if ($sFileType=="file"){
				$oFiles[] = $file;
			}
		}
	}

	if (isset($oDirs)){
		foreach($oDirs as $oDir){
			$sDirName = $path . $oDir;
			$temp[] = array($oDir, "文件夹", GetSizeUnit(getDirSize($sDirName)), date("Y-m-d H:i:s",filectime($sDirName)), date("Y-m-d H:i:s",fileatime($sDirName)));
		}
	}

	if (isset($oFiles)){
		foreach($oFiles as $oFile){
			$sFileName = $path . $oFile;
			$temp[] = array($oFile, substr($oFile,strrpos($oFile,".")+1), GetSizeUnit(filesize($sFileName)), date("Y-m-d H:i:s",filectime($sFileName)), date("Y-m-d H:i:s",fileatime($sFileName)));
		}
	}

	if ($page==""){
		$page=1;
	} 
	if (!is_numeric($page) || $page<1){
		$page=1;
	} 

	$page=intval($page);
	$s_num=0; 
	$e_num=count($temp)-1;

	if ($MaxPerPage>0){
		$s_num=($page-1)*$MaxPerPage; 
		$e_num=$page*$MaxPerPage-1;
	} 
	if ($e_num>(count($temp)-1)){
		$e_num=count($temp)-1;
	} 
	if (($s_num>$e_num) && $e_num>=0){
		$s_num=$s_num-$MaxPerPage;
		if ($page>1){
			$page=$page-1;
		} 
	} 

	for ($i=$s_num; $i<=$e_num; $i++){
		if ($mode[1]=="0"){
			echo "<tr align=center><td>".$temp[$i][1]."</td><td align=left>".GetLinkFile($temp[$i][1],$temp[$i][0],$cup)."</td><td>".$temp[$i][2]."</td><td>".$temp[$i][3]."</td><td>".$temp[$i][4]."</td><td><input type=checkbox name=ff[] value=\"".iconv('GB2312','UTF-8',$temp[$i][0])."\" id=ff".$i."></td></tr>";
		}else{
			echo "<div class=picmode><table class=pic><tr bgcolor=#00ccff><td>".GetPrePic($temp[$i][1],$temp[$i][0],$cup)."</td></tr><tr bgcolor=#00ccff><td align=left>".GetLinkFile($temp[$i][1],$temp[$i][0],$cup)."</td></tr bgcolor=#00ccff><tr><td>".$temp[$i][2]."</td></tr><tr><td>".$temp[$i][3]."</td></tr><tr><td>".$temp[$i][4]."</td></tr><tr><td align=left><input type=checkbox name=ff[] value=\"".iconv('GB2312','UTF-8',$temp[$i][0])."\" id=ff".$i.">　<a href=# onclick='if(confirm(\"确定要删除该文件(夹)吗\")){document.getElementById(\"ff".$i."\").checked=true;upform.submit()};return false;'>删除</a></td></tr></table></div>";
		} 
	}

	if ($mode[1]=="0"){
		echo "<tr><td height=25 colspan=6 align=center style='background:#fefefe;'>";
	}else{
		echo "</div><div class=page>";
	} 

	echo "<table style='width:100%;border:0;background:#fefefe;'><tr>";
	echo "<td style='background:#fefefe;' width='80%' align='center'>";

	if ($MaxPerPage>0 && count($temp)>=1){
		if (count($temp) % $MaxPerPage==0){
			$MaxPage = count($temp) / $MaxPerPage;
		}else{
			$MaxPage = (count($temp)-(count($temp) % $MaxPerPage)) / $MaxPerPage + 1;
		} 
		if ($page==1){
			echo "首页";
			echo "　上一页";
		}else{
			echo "<a href=\"#\" onclick=\"upform.page.value='1';upform.submit()\">首页</a>";
			echo "　<a href=\"#\" onclick=\"upform.page.value='".($page-1)."';upform.submit();\">上一页</a>";
		} 
		if ($page==$MaxPage){
			echo "　下一页";
			echo "　末页";
		}else{
			echo "　<a href=\"#\" onclick=\"upform.page.value='".($page+1)."';upform.submit()\">下一页</a>";
			echo "　<a href=\"#\" onclick=\"upform.page.value='".$MaxPage."';upform.submit()\">末页</a>";
		} 
		echo "　页码：[".$page." / ".$MaxPage."]　每页显示".$MaxPerPage."条　共条".(count($temp)+1)."记录";
	} 

	echo "</td>";
	echo "<td style='background:#fefefe;' width='20%' align=center><input type=button value='反选' onclick='ffselect(this.form,0)'> <input type=button value='全选' onclick='ffselect(this.form,1)'> <input type=button value='删除所选' onclick='if(confirm(\"确定要删除选中的文件(夹)吗\")){this.form.submit()}'></<td></tr></table>";
	echo "<input type=hidden name=page value='".$page."'>";

	if ($mode[1]=="0"){
		echo "</td></tr>";
	}else{
		echo "";
	} 
} 

function GetLinkFile($ft,$fn,$c){
	$fn = iconv('GB2312','UTF-8',$fn);
	$c = iconv('GB2312','UTF-8',$c);
	if ($ft=="文件夹"){
		$temp="<a href=\"#\" onclick=\"upform.cUpdir.value='".$c.$fn."/';upform.submit();\">".$fn."</a>";
	}else{
		$temp="<a href=\"".$GLOBALS["EditorBasePath"].$c.$fn."\" target=_blank>".$fn."</a>";
	} 
	return $temp;
} 


function GetPrePic($a,$b,$c){
	$b = iconv('GB2312','UTF-8',$b);
	$c = iconv('GB2312','UTF-8',$c);
	if ($a=="文件夹"){
		$temp="<div class=pic2 onclick=\"upform.cUpdir.value='".$c.$b."/';upform.submit();\"><table height='100%'><tr><td class=folder align=center>".$a." ".$b."</td></tr></table></div>";
	}else{
		$EditorBasePath = $GLOBALS["EditorBasePath"];
		if (strpos(",jpg,jpeg,gif,bmp,png",$a)!=0){
			$temp = "<img src='".$EditorBasePath.$c.$b."' class=pic2 onclick='window.open(this.src)'>";
		}else if (strpos(",swf",strtolower($a))!=0){
			$temp = "<embed src='".$EditorBasePath.$c.$b."' class=pic2 type=application/x-shockwave-flash quality='high' play='false' loop='true'></embed>";
		}else if (strpos(",mp3,wma,mid,midi,mpeg,mpg,wmv,asf,asx",strtolower($a))!=0){
			$temp = "<div class=pic2 onclick=\"previewmedia('".DomainPath(RootPath($EditorBasePath.$c)).$b."','wmp')\"><table height='100%'><tr><td class=media align=center>MediaPlayer预览 ".$b."</td></tr></table></div>";
		}else if (strpos(",rm,rmvb,ra,avi",strtolower($a))!=0){
			$temp = "<div class=pic2 onclick=\"previewmedia('".DomainPath(RootPath($EditorBasePath.$c)).$b."','real')\"><table height='100%'><tr><td class=real align=center>RealPlayer预览 ".$b."</td></tr></table></div>";
		}else{
			$temp = "<div class=pic2><table height='100%'><tr><td align=center>".$a." ".$b."</td></tr></table></div>";
		} 
	} 
	return $temp;
} 

function RootPath($url) {
	$sTempUrl = $url;
	if (substr($sTempUrl, 0, 1) == "/") {
		return $sTempUrl;
	} 
	if (isset($_SERVER["REQUEST_URI"])) {
		$sWebEditorPath = $_SERVER["REQUEST_URI"];
	} else {
		$sWebEditorPath = $_SERVER["SCRIPT_NAME"];
	} 
	$sWebEditorPath = substr($sWebEditorPath, 0, strrpos($sWebEditorPath, "/"));
	while (substr($sTempUrl, 0, 3) == "../") {
		$sTempUrl = substr($sTempUrl, 3, strlen($sTempUrl));
		$sWebEditorPath = substr($sWebEditorPath, 0, strrpos($sWebEditorPath, "/"));
	} 
	return $sWebEditorPath . "/" . $sTempUrl;
} 
function DomainPath($url) {
	$sProtocol = explode("/", $_SERVER["SERVER_PROTOCOL"]);
	$sHost = strtolower($sProtocol[0]) . "://" . $_SERVER["HTTP_HOST"];
	$sPort = $_SERVER["SERVER_PORT"];
	if ($sPort != "80") {
		$sHost = $sHost . ":" . $sPort;
	} 
	return $sHost . $url;
} 

function DeleteAFile($path){
	$errnum = 0;
	if (file_exists($path)){
		if(is_dir($path)){
			$errnum += removeDir($path);
		}else if(is_file($path)){
			if(is_writable($path)){
				unlink($path);
			}else{
				$errnum++;
			}
		}
	} 
	return $errnum;
} 

function removeDir($path) {
	// Add trailing slash to $path if one is not there
	if (substr($path, -1, 1) != "/") {
		$path .= "/";
	}
	$errnum = 0;
	$normal_files = glob($path . "*");
	$hidden_files = glob($path . "\.?*");
	$all_files = array_merge($normal_files, $hidden_files);

	foreach ($all_files as $file) {
	# Skip pseudo links to current and parent dirs (./ and ../).
		if (preg_match("/(\.|\.\.)$/", $file)){
			continue;
		}

		if (is_file($file) === TRUE) {
			// Remove each file in this Directory
			if(is_writable($file)){
				unlink($file);
			}else{
				$errnum++;
			}
		
		}
		else if (is_dir($file) === TRUE) {
			// If this Directory contains a Subdirectory, run this Function on it
			$errnum += removeDir($file);
		}
	}
	// Remove Directory once Files have been removed (If Exists)
	if (is_dir($path) === TRUE) {
		if(is_writable($path) && is_dir_empty($path)){
			rmdir($path);
		}else{
			$errnum++;
		}
	}
	return $errnum;
}


function GetUbound($s){
  if (!is_array($s)){
    $temp_num=-1;
  }else{
    $temp_num=count($s)-1;
  } 
  return $temp_num;
} 

function ArryForms(){
    return Array("d_name","d_width","d_height","d_memo","d_initmode","d_fixwidth","d_skin","d_stateflag","d_sbcode","d_sbedit","d_sbtext","d_sbview","d_detectfromword","d_autoremote","d_showborder","d_autodetectlanguage","d_defaultlanguage","d_entermode","d_areacssmode","d_serverext","d_uploadobject","d_autodir","d_allowbrowse","d_cusdirflag","d_baseurl","d_uploaddir","d_basehref","d_contentpath","d_imageext","d_flashext","d_mediaext","d_fileext","d_remoteext","d_localext","d_imagesize","d_flashsize","d_mediasize","d_filesize","d_remotesize","d_localsize","d_sltsyobject","d_sltsyext","d_sltflag","d_sltminsize","d_sltoksize","d_sywzflag","d_sywzminwidth","d_sywzminheight","d_sytext","d_syfontcolor","d_syshadowcolor","d_syshadowoffset","d_syfontsize","d_syfontname","d_sywzposition","d_sywzpaddingh","d_sywzpaddingv","d_sywztextwidth","d_sywztextheight","d_sytpflag","d_sytpminwidth","d_sytpminheight","d_sytpposition","d_sytppaddingh","d_sytppaddingv","d_sypicpath","d_sytpopacity","d_sytpimagewidth","d_sytpimageheight");
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


function IsHavestyle($s,$arry){

	for ($i=0; $i<=GetUbound($arry); $i++){
		if(is_array($arry[$i])){
			if(is_array($arry[$i][0])){
				if (strtolower($s)==strtolower($arry[$i][0][0])){
					return true;
				} 
			}
		}
	}
	return false;
} 

//创建指定文件，并写入文本str;
function CreateAfile($str,$path){

	if(is_writable($path)){
		$MyFile=fopen($path, "w");
		fputs($MyFile,$str."\n");
		fclose($MyFile);
		$MyFile=null;
	}else{

		ErrorBack("权限不足,写入文件失败");
	}
} 

function DoProductFile($mode){
	
	if (isset($GLOBALS["Mystyle"])){
		$Mystyle = $GLOBALS["Mystyle"];
	}else{
		$Mystyle = array();
	}
	$Back_Arry = array();

	switch ($mode){
		case "styleadd":
			if (IsHavestyle(TrimPost("d_name"),$Mystyle)){
				ErrorBack("已存在同名样式:".TrimPost("d_name"));
				die();
			} 
			$tmp_arr = array(ReadFA(ArryForms()),array());
			array_unshift($Mystyle,$tmp_arr);
			$Back_Arry[0] = "新增样式" . TrimPost("d_name") . "成功";
			$Back_Arry[1] = PhilSName() . "?action=style";
			break;
		case "styleset":
			$id = TrimGet("id");
			$Mystyle[$id][0] = ReadFA(ArryForms());
			$Back_Arry[0] = "修改样式" . TrimPost("d_name") . "成功";
			$Back_Arry[1] = PhilSName() . "?action=style";
			break;
		case "styledel":
			$id = TrimGet("id");
			$sname = $Mystyle[$id][0][0];
			array_splice($Mystyle,$id,1);
			$Back_Arry[0] = "删除样式" . $sname . "成功";
			$Back_Arry[1] = PhilSName() . "?action=style";
			break;
		case "toolbardel":
			$id = TrimGet("id");
			$tid = TrimGet("tid");
			array_splice($Mystyle[$id][1],$tid,1);
			$Back_Arry[0] = "";
			$Back_Arry[1] = PhilSName() . "?action=d_toolbar&id=" . $id;
			break;
		case "toolbaradd":
			$id = TrimGet("id");
			
			if ($Mystyle[$id][1][0][0]==""){
				$Mystyle[$id][1][0] = array(TrimPost("d_name"),"");
			}else{
				$Mystyle[$id][1][] = array(TrimPost("d_name"),"");
			}
			$Back_Arry[0] = "";
			$Back_Arry[1] = PhilSName() . "?action=d_toolbar&id=" . $id;
			break;
		case "toolbarset":
			$id = TrimGet("id");
			$d_name = $_POST["d_name"];
			$d_order = $_POST["d_order"];
			for($i=0;$i<count($d_name);$i++){
				$Mystyle[$id][1][$i][0] = $d_name[$i];
				array_push($Mystyle[$id][1][$i][2],$d_order[$i]);
			}
			array_multisort($d_order, SORT_ASC, $d_name, SORT_ASC, $Mystyle[$id][1]);
			for($i=0;$i<count($d_name);$i++){
				array_pop($Mystyle[$id][1][$i]);
			}
			$Back_Arry[0] = "";
			$Back_Arry[1] = PhilSName() . "?action=d_toolbar&id=" . $id;
			break;
		case "buttonset":
			$id = TrimGet("id");
			$tid = TrimGet("tid");
			$d_button = str_replace("|",",",TrimPost("d_button"));
			$Mystyle[$id][1][$tid][1] = $d_button;
			$Back_Arry[0] = "样式(".$Mystyle[$id][0][0].")工具栏(".$Mystyle[$id][1][$tid][0].")下按纽设置成功!";
			$Back_Arry[1] = PhilSName() . "?action=d_toolbar&id=" . $id;
			break;
	} 

	$temp_str = "";
	$temp_str .= "<?php"."\r\n";
	$temp_str .= "\$Mystyle = array();"."\r\n";
	for ($i=0; $i<count($Mystyle); $i++){
	$temp_str .= "\$Mystyle[".$i."] = array(".ReadAA($Mystyle[$i]).");"."\r\n";
	}
	$temp_str .= "?>";

	CreateAfile($temp_str, $GLOBALS["PHPConfigPath"]);
	ErrorGoto ($Back_Arry[0],$Back_Arry[1],"self");

} 

function ReadAA($s){
	$temp_str = "";
	for ($i=0; $i<count($s); $i++){
		if (is_array($s[$i])){
			if ($i==0){
				$temp_str .= "array(";
			}else{
				$temp_str .= ",array(";
			} 
			$temp_str .= ReadAA($s[$i]);
			$temp_str .= ")";
		}else{
			if ($i==0){
				$temp_str .= "\"".$s[$i]."\"";
			}else{
				$temp_str .= ",\"".$s[$i]."\"";
			} 
		} 
	}
	return $temp_str;
} 


function ReadFA($s){
  $tmp_arr = array();
  for ($i=0; $i<count($s); $i++){
	$tmp_arr[] = TrimPost($s[$i]);
  }
  return $tmp_arr;
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


function check_urlcome(){
	$myurl=$_SERVER['SERVER_NAME'];
	if(isset($_SERVER['HTTP_REFERER'])){
		$url1=explode('://',$_SERVER['HTTP_REFERER']);
		$url2=explode('/',$url1[1]);
		if(strtolower($myurl) == strtolower($url2[0])){
			return true;
		}
	}
}

//检查目录是否为空;
function is_dir_empty($path){
	$handle = opendir($path); 
	while (false !== ($file = readdir($handle))) {
		if($file == '.' || $file == '..'){
			continue;
		}
		$file_array[] = $file;
	}
	if(!isset($file_array)){//没有文件;
		closedir($handle);
		return true;
	}
	closedir($handle);
	return false;//有文件;
}



?>