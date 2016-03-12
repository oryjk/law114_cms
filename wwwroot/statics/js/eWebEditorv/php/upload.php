<?php
header("Content-Type: text/html;charset=utf-8");

require("config.php");

InitUpload();

switch(strtolower($GLOBALS["cAction"])){
	case "save":
         DoUpSave();    // 上传文件--
         DoUpOver();    // 上传结果处理--
		 break;
	case "remote":
         DoRemote();   // 远程文件自动上传--
		 break;
	case "local":
         DoLocal();    // 本地文件自动上传--
		 break;
}

//可以在此扩展其它上传类或组件; Upload之后,初始化以下变量即可.--
//UpErrNum, cFileName, cFilePath, sFileName, sFileExt, sPathFileName--
function DoUpSave(){
	if (($GLOBALS["UpErrNum"] == -1 Or $GLOBALS["UpErrNum"] == 2) && $GLOBALS["cAction"]=="save") return;
	switch($GLOBALS["sUpObj"]){
		case "0" :  
			DoUpload(); break;
		default :
			DoUpload(); break;
	}
}

//初始化变量--
function InitUpload(){
	
	//存储客户端QueryString--
	global $id, $cAction, $cType, $cStyle, $cCusDir, $cPathFileName; 

	//从Mystyle中，文件上传相关参数--
	global $sType, $sMaxsize, $sAutoDir, $sBaseUrl, $sContentPath, $sBaseHref, $sCusDirFlag, $sUpObj, $id;
	
	//上传全路径，根目录，新建目录, $返回的错误代码--
	global $UpPath, $UpBasePath, $UpNewPath, $UpErrNum;

	//上传文件相关变量: 原文件名，新文件名，新文件名带全路径--
	global $sFileName, $sPathFileName, $sFileExt, $cFileName, $cFilePath;
	
	global $sImageFile, $sImagePathFile, $sImageScript;  //缩微图相关变量--
	global $sltFlag, $sltMinsize, $sltOksize;  //缩微图--
	global $sywzFlag, $sywzpaddH, $sywzpaddV;  //文字水印--
	global $sytpFlag, $sytppaddH, $sytppaddV;  //图片水印--
	global $nSLTSYObject, $sSLTSYExt;
	global $nFileNum;

	$cAction = TrimGet("action");
	$cType = TrimGet("type");
	$cStyle = TrimGet("style");
	$cCusDir = TrimGet("cusdir");
	$id = GetStyleId($cStyle);  //加载样式下标--
	if($id == -1) OutScript("parent.UploadError('style')");

	$Mystyle = $GLOBALS["Mystyle"];
	$sUpObj = $Mystyle[$id][0][20];
	$sCusDirFlag = $Mystyle[$id][0][23];

	if ($cCusDir<>"" && $sCusDirFlag == "1"){  //是否启用自定义上传路径--
	    $UpBasePath = $cCusDir;
	}else{
	    $UpBasePath = $Mystyle[$id][0][25];
	}
	$UpBasePath = FMP($UpBasePath);
	if (substr($UpBasePath,0,1)!="/" && strpos($UpBasePath,":")==0){  //使上传路径以编辑器所在目录为根目录--
	    $UpBasePath = "../" . $UpBasePath;
	} 
    //初始化分类目录--
    switch(strtolower($cType)){
        case "image" :
		    $sMaxsize = $Mystyle[$id][0][34];
			$sType = $Mystyle[$id][0][28];
			$UpNewPath .= "/Image/"; break;
		case "flash" :
		    $sMaxsize = $Mystyle[$id][0][35];
			$sType = $Mystyle[$id][0][29];
			$UpNewPath .= "/Flash/"; break;
		case "media" :
		    $sMaxsize = $Mystyle[$id][0][36];
			$sType = $Mystyle[$id][0][30];
			$UpNewPath .= "/Media/"; break;
		case "file" :
		    $sMaxsize = $Mystyle[$id][0][37];
			$sType = $Mystyle[$id][0][31];
			$UpNewPath .= "/Other/"; break;
		case "remote" :
		    $sMaxsize = $Mystyle[$id][0][38];
			$sType = $Mystyle[$id][0][32];
			$UpNewPath .= "/Image/"; break;
		case "local" :
		    $sMaxsize = $Mystyle[$id][0][39];
			$sType = $Mystyle[$id][0][33];
			$UpNewPath .= "/Image/"; break;
	}

	$sAutoDir = $Mystyle[$id][0][21];
	//初始化时间目录--
    switch($sAutoDir){
        Case "0" : $strDate = ""; break;
		Case "1" : $strDate = date("Y"); break;
		Case "2" : $strDate = date("Y-m"); break;
		Case "3" : $strDate = date("Y-m-d"); break;
	}
	if($strDate!="") $UpNewPath .= $strDate . "/";
	$UpPath = FMP($UpBasePath . $UpNewPath);
	$ArryUpdir = explode("/",$UpPath);
	$temp_dir = "";
	for ($u=0; $u<count($ArryUpdir);$u++){
        $temp_dir .= $ArryUpdir[$u] . "/";
        $temp_dir = FMP($temp_dir);
		if ($ArryUpdir[$u]!="" && $ArryUpdir[$u]<>".." && strpos($ArryUpdir[$u],":")==0){ 
           CreateAFolder($temp_dir);
		}
	}

	$sBaseUrl = $Mystyle[$id][0][24];
	$sContentPath = $Mystyle[$id][0][27];
	$sBaseHref = $Mystyle[$id][0][26];
	//初始化内容路径--
	switch($sBaseUrl){
		
        Case "0" : $sContentPath = $sBaseHref . $sContentPath . $UpPath; break;
		Case "1" : $sContentPath = RelativePath2RootPath($UpPath); break;
		Case "2" : $sContentPath = RootPath2DomainPath(RelativePath2RootPath($UpPath)); break;
		Case "3" : $sContentPath .= $UpNewPath; break;
	}

    //原文件名--
	$cPathFileName = str_replace("\\","/",TrimGet("uploadfile"));
	if (strpos(substr($cPathFileName, strrpos($cPathFileName, "/")+1),":")) $cPathFileName = "";
	//初始化文件名--
    $cFileName = substr($cPathFileName, strrpos($cPathFileName, "/")+1);
	$cFilePath = substr($cPathFileName, 0, strrpos($cPathFileName, "/")-1);
	$sFileExt = substr($cPathFileName, strrpos($cPathFileName, ".")+1);
	$sFileName = GetDateFileName() . "." . $sFileExt;
	$sPathFileName = $sContentPath . $sFileName;
    if($cPathFileName==""){
	    $UpErrNum = -1;
	}else{ 
		$ExtMatch = false;
		$arrstype = explode("|",$sType);
		for ($i=0;$i<count($arrstype);$i++){
			if(strtolower($sFileExt) == strtolower($arrstype[$i])) $ExtMatch = true;
		}
		if (!$ExtMatch) $UpErrNum = 2;
	} 

	$nSLTSYObject = $Mystyle[$id][0][40];
	$sSLTSYExt =  $Mystyle[$id][0][41];
	$sltFlag =  $Mystyle[$id][0][42];
	if (TrimGet("sltflag")!="")  $sltflag = TrimGet("sltflag");
	$sltMinsize = $Mystyle[$id][0][43];
	$sltOksize =$Mystyle[$id][0][44];
    $sywzFlag = $Mystyle[$id][0][45];
	if (TrimGet("sywzflag")!="")  $sywzflag = TrimGet("sywzflag");
    $sytpFlag = $Mystyle[$id][0][59];
	if (TrimGet("sytpflag")!="")  $sytpflag = TrimGet("sytpflag");
	$sywzpaddH = $Mystyle[$id][0][55];
	$sywzpaddV = $Mystyle[$id][0][56];
    $sytppaddH = $Mystyle[$id][0][63];
	$sytppaddV = $Mystyle[$id][0][64];
}

//返回mystyle当前样式数组下标--
function GetStyleId($n){
	$arry = $GLOBALS["Mystyle"];
	for ($i=0;$i<count($arry);$i++){
		$v = $arry[$i][0][0];
		if (strtolower($n) == strtolower($v)){
			return $i;
		}
	}
	return -1;
}

function FMP($a){
    $s = str_replace("\\","/",$a);
	$s = str_replace("//","/",$s);
	return $s;
}


function CreateAFolder($s_Folder) {
	if (!is_dir($s_Folder)) {
		mkdir($s_Folder);
	} 
} 


function OutScriptNoBack($str) {
	echo "<script language=javascript>" . $str . "</script>";
} 
function OutScript($str) {
	echo "<script language=javascript>" . $str . ";history.back()</script>";
} 

function DoPHPSYSLT(){

	$sImageFile = getSmallImageFile($GLOBALS["sFileName"]);
	$sImagePathFile = "";
	$sImageScript = "";
	if (makeImageSLT($GLOBALS["UpPath"], $GLOBALS["sFileName"], $sImageFile)) {
		makeImageSY($GLOBALS["UpPath"], $sImageFile);
		makeImageSY($GLOBALS["UpPath"], $GLOBALS["sFileName"]);
		$GLOBALS["sImagePathFile"] = $GLOBALS["sContentPath"] . $sImageFile;
		$GLOBALS["sImageScript"] = "try{obj.addUploadFile('" . ChkcFileName($GLOBALS["cFileName"]) . "', '" . $sImageFile . "', '" . $sImagePathFile . "');} catch(e){} ";
	} else {
		$sImageFile = "";
		makeImageSY($GLOBALS["UpPath"], $GLOBALS["sFileName"]);
	} 

}

//上传结果处理--
function DoUpOver(){
    switch($GLOBALS["UpErrNum"]){
        Case 0 : //成功上传--
		    DoPHPSYSLT();
	        OutScript("parent.UploadSaved('" . $GLOBALS["sPathFileName"] . "','" . $GLOBALS["sImagePathFile"] . "');var obj=parent.dialogArguments.dialogArguments;if (!obj) obj=parent.dialogArguments;try{obj.addUploadFile('" . ChkcFileName($GLOBALS["cFileName"]) . "', '" . $GLOBALS["sFileName"] . "', '" . $GLOBALS["sPathFileName"] . "');} catch(e){} " . $GLOBALS["sImageScript"]); break;
		Case 1 : //大小超过限制--
			OutScript("parent.UploadError('size')"); break;
		Case 2 : //类型不符合--
			OutScript("//parent.UploadError('ext')"); break;
		Case 3 : //大小及类型都不符合--
		    OutScript("parent.UploadError('size_ext')"); break;
		Case -1 : //没有文件上传--
		    OutScript("parent.UploadError('file')"); break;
		Case 4 : //失败未知原因--
		    OutScript("alert('upload failed : unkown case')"); break;
	}
}
function ChkcFileName($a){
	$s = iconv('GB2312','UTF-8',$a);
    $s = str_replace("(","&#40;",$s);
	$s = str_replace(")","&#41;",$s);
	$s = str_replace("'","&#39;",$s);
	return $s;
}
//无组上传--
function DoUpload(){
	//没有文件上传--
	if (!is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
		$GLOBALS["UpErrNum"] = -1;
		return;
	}

    $file = $_FILES["uploadfile"];
	$type = $file["type"];
	$size = $file["size"];
	$tmp_name = $file["tmp_name"];
	$error = $file["error"];
	$path_info = pathinfo($file["name"]);

	//检查文件类型;
    if(!in_array(strtolower($path_info["extension"]), explode("|",strtolower($GLOBALS["sType"])))){
		$GLOBALS["UpErrNum"] = 2;
        return;
    }
	
	//检查大小;
    if(($GLOBALS["sMaxsize"] * 1024) < $file["size"]){
        $GLOBALS["UpErrNum"] = 1;
        return;
    }

    $GLOBALS["cFileName"] = $path_info["basename"];
	$GLOBALS["cFilePath"] = $path_info["dirname"];
	$GLOBALS["sFileExt"] = $path_info["extension"];
	$GLOBALS["sFileName"] = GetRndFileName($path_info["extension"]);
	$GLOBALS["sPathFileName"] = $GLOBALS["sContentPath"] . $GLOBALS["sFileName"];

	$uPathFileName = $GLOBALS["UpPath"] . $GLOBALS["sFileName"];
	if(substr($uPathFileName,0,1)=="/") $uPathFileName = $_SERVER['DOCUMENT_ROOT'] . $uPathFileName;
    error_log($uPathFileName.",".$tmp_name);
	//移动文件;
    if(!move_uploaded_file($tmp_name, $uPathFileName)){
		$GLOBALS["UpErrNum"] = 4; //其它意外;
    }else{
		$GLOBALS["UpErrNum"] = 0; //上传成功;
	}
}

//远程文件自动上传--
function DoRemote(){

	if (isset($_POST["eWebEditor_UploadText"])) {
		$sContent = stripslashes($_POST["eWebEditor_UploadText"]);
	} else {
		$sContent = "";
	} 
	if (($GLOBALS["sType"] != "") && ($sContent != "")) {
		$sContent = ReplaceRemoteUrl($sContent, $GLOBALS["sType"]);
	} 
	echo "<html><head><title>eWebEditor</title><meta http-equiv='Content-Type' content='text/html; charset=gb2312'></head><body>" . "<input type=hidden id=UploadText value=\"" . inHTML($sContent) . "\">" . "</body></html>";
	OutScriptNoBack("parent.setHTML(UploadText.value);try{parent.addUploadFile('" . ChkcFileName($GLOBALS["cFileName"]) . "', '" . $GLOBALS["sFileName"] . "', '" . $GLOBALS["sPathFileName"] . "');} catch(e){} parent.remoteUploadOK();");

}

//本地文件自动上传--
function DoLocal(){
    DoUpSave();
	if($GLOBALS["UpErrNum"]=="0"){
        echo $GLOBALS["sPathFileName"];
	}
}


function makeImageSY($s_Path, $s_File) {
	if (($GLOBALS["sywzFlag"] == 0) && ($GLOBALS["sytpFlag"] == 0)) {
		return false;
	} 
	if (!isValidSLTSYExt($s_File)) {
		return false;
	} 
	switch ($GLOBALS["nSLTSYObject"]) {
		case 0:
			$groundImage = $s_Path . $s_File;
			if (!file_exists($groundImage)) {
				return false;
			} 
			$ground_info = getimagesize($groundImage);
			$ground_w = $ground_info[0];
			$ground_h = $ground_info[1];
			switch ($ground_info[2]) {
				case 1:
					$ground_im = imagecreatefromgif($groundImage);
					break;
				case 2:
					$ground_im = imagecreatefromjpeg($groundImage);
					break;
				case 3:
					$ground_im = imagecreatefrompng($groundImage);
					break;
				default:
					return false;
			} 
			imagealphablending($ground_im, true);
			if ($GLOBALS["sywzFlag"] == 1) {
				if (($ground_w < $GLOBALS["Mystyle"][$GLOBALS["id"]][0][46]) || ($ground_h < $GLOBALS["Mystyle"][$GLOBALS["id"]][0][47])) {
					return false;
				} 
				$posX = getSYPosX($GLOBALS["Mystyle"][$GLOBALS["id"]][0][54], $ground_w, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][57] + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $GLOBALS["sywzpaddH"]);
				$posY = getSYPosY($GLOBALS["Mystyle"][$GLOBALS["id"]][0][54], $ground_h, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][58] + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $GLOBALS["sywzpaddV"]);
				if ($GLOBALS["Mystyle"][$GLOBALS["id"]][0][53]) {
					$s_SYText = $GLOBALS["Mystyle"][$GLOBALS["id"]][0][48];
					$fontSize = imagettfbbox($GLOBALS["Mystyle"][$GLOBALS["id"]][0][52], 0, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][53], $s_SYText);
					$n_SYWidth = $fontSize[2] - $fontSize[0];
					$n_SYHeight = $fontSize[1] - $fontSize[7];
				} 
				if ($GLOBALS["Mystyle"][$GLOBALS["id"]][0][50] == "") {
					$GLOBALS["Mystyle"][$GLOBALS["id"]][0][50] = "ffffff";
				} 
				$R = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][50], 0, 2));
				$G = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][50], 2, 2));
				$B = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][50], 4));
				$textcolor = imagecolorallocate($ground_im, $R, $G, $B);
				if ($GLOBALS["Mystyle"][$GLOBALS["id"]][0][53]) {
					imagettftext($ground_im, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][52], 0, $posX + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $posY + $n_SYHeight + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $textcolor, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][53], $s_SYText);
				} else {
					imagestring($ground_im, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][52], $posX + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $posY + $GLOBALS["Mystyle"][$GLOBALS["id"]][0][51], $GLOBALS["Mystyle"][$GLOBALS["id"]][0][48], $textcolor);
				} 
				if ($GLOBALS["Mystyle"][$GLOBALS["id"]][0][49] == "") {
					$GLOBALS["Mystyle"][$GLOBALS["id"]][0][49] = "000000";
				} 
				$R = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][49], 0, 2));
				$G = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][49], 2, 2));
				$B = hexdec(substr($GLOBALS["Mystyle"][$GLOBALS["id"]][0][49], 4));
				$textcolor = imagecolorallocate($ground_im, $R, $G, $B);
				if ($GLOBALS["Mystyle"][$GLOBALS["id"]][0][53]) {
					imagettftext($ground_im, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][52], 0, $posX, $posY + $n_SYHeight, $textcolor, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][53], $s_SYText);
				} else {
					imagestring($ground_im, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][52], $posX, $posY, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][48], $textcolor);
				} 
			} 
			if ($GLOBALS["sytpFlag"] == 1) {
				$waterImage = $GLOBALS["Mystyle"][$GLOBALS["id"]][0][65];
				if (!file_exists($waterImage)) {
					return false;
				} 
				$water_info = getimagesize($waterImage);
				$water_w = $water_info[0];
				$water_h = $water_info[1];
				switch ($water_info[2]) {
					case 1:
						$water_im = imagecreatefromgif($waterImage);
						break;
					case 2:
						$water_im = imagecreatefromjpeg($waterImage);
						break;
					case 3:
						$water_im = imagecreatefrompng($waterImage);
						break;
					default:
						return false;
				} 
				// if(($ground_w<$water_w)||($ground_h<$water_h)){return false;}
				if (($ground_w < $GLOBALS["Mystyle"][$GLOBALS["id"]][0][60]) || ($ground_h < $GLOBALS["Mystyle"][$GLOBALS["id"]][0][61])) {
					return false;
				} 
				$posX = getSYPosX($GLOBALS["Mystyle"][$GLOBALS["id"]][0][62], $ground_w, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][67], $GLOBALS["sytppaddH"]);
				$posY = getSYPosY($GLOBALS["Mystyle"][$GLOBALS["id"]][0][62], $ground_h, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][68], $GLOBALS["sytppaddV"]);
				imagecopymerge($ground_im, $water_im, $posX, $posY, 0, 0, $water_w, $water_h, $GLOBALS["Mystyle"][$GLOBALS["id"]][0][66] * 100);
			} 
			// @unlink($groundImage);
			switch ($ground_info[2]) {
				case 1:
					imagegif($ground_im, $groundImage);
					break;
				case 2:
					imagejpeg($ground_im, $groundImage);
					break;
				case 3:
					imagepng($ground_im, $groundImage);
					break;
			} 
			if (isset($water_info)) unset($water_info);
			if (isset($water_im)) imagedestroy($water_im);
			unset($ground_info);
			imagedestroy($ground_im);
			break;
		default:
			break;
	} 
	return true;
} 
function getSYPosX($posFlag, $originalW, $syW, $paddingH) {
	switch ($posFlag) {
		case 1:
		case 2:
		case 3:
			return $paddingH;
			break;
		case 4:
		case 5:
		case 6:
			return floor(($originalW - $syW) / 2);
			break;
		case 7:
		case 8:
		case 9:
			return ($originalW - $paddingH - $syW);
			break;
	} 
} 
function getSYPosY($posFlag, $originalH, $syH, $paddingV) {
	switch ($posFlag) {
		case 1:
		case 4:
		case 7:
			return $paddingV;
			break;
		case 2:
		case 5:
		case 8:
			return floor(($originalH - $syH) / 2);
			break;
		case 3:
		case 6:
		case 9:
			return ($originalH - $paddingV - $syH);
			break;
	} 
} 
function makeImageSLT($s_Path, $s_File, $s_SmallFile) {
	if ($GLOBALS["sltFlag"] == 0) {
		return false;
	} 
	if (!isValidSLTSYExt($s_File)) {
		return false;
	} 
	switch ($GLOBALS["nSLTSYObject"]) {
		case 0:
			$s_Ext = substr(strrchr($s_File, "."), 1);
			switch ($s_Ext) {
				case "png":
					$im = imagecreatefrompng($s_Path . $s_File);
					break;
				case "gif":
					$im = imagecreatefromgif($s_Path . $s_File);
					break;
				default:
					$im = imagecreatefromjpeg($s_Path . $s_File);
					break;
			} 
			if (!$im) {
				return false;
			} 
			$n_OriginalWidth = imagesx($im);
			$n_OriginalHeight = imagesy($im);
			if (($n_OriginalWidth < $GLOBALS["sltMinsize"]) && ($n_OriginalHeight < $GLOBALS["sltMinsize"])) {
				return false;
			} 
			if ($n_OriginalWidth > $n_OriginalHeight) {
				$n_Width = $GLOBALS["sltOksize"];
				$n_Height = ($GLOBALS["sltOksize"] / $n_OriginalWidth) * $n_OriginalHeight;
			} else {
				$n_Height = $GLOBALS["sltOksize"];
				$n_Width = ($GLOBALS["sltOksize"] / $n_OriginalHeight) * $n_OriginalWidth;
			} 
			if (function_exists("imagecopyresampled")) {
				$newim = imagecreatetruecolor($n_Width, $n_Height);
				imagecopyresampled($newim, $im, 0, 0, 0, 0, $n_Width, $n_Height, $n_OriginalWidth, $n_OriginalHeight);
			} else {
				$newim = imagecreate($n_Width, $n_Height);
				imagecopyresized($newim, $im, 0, 0, 0, 0, $n_Width, $n_Height, $n_OriginalWidth, $n_OriginalHeight);
			} 
			touch($s_Path . $s_SmallFile);
			switch ($s_Ext) {
				case "png":
					imagepng($newim, $s_Path . $s_SmallFile);
					break;
				case "gif":
					imagegif($newim, $s_Path . $s_SmallFile);
					break;
				default:
					imagejpeg($newim, $s_Path . $s_SmallFile);
					break;
			} 
			imagedestroy($newim);
			imagedestroy($im);
			break;
		default:
			break;
	} 
	return true;
} 
function isValidSLTSYExt($s_File) {
	$sExt = substr(strrchr($s_File, "."), 1);
	$aExt = explode('|', strtoupper($GLOBALS["sSLTSYExt"]));
	if (!in_array(strtoupper($sExt), $aExt)) {
		return false;
	} 
	return true;
} 
function getSmallImageFile($s_File) {
	$exts = explode(".", $s_File);
	return $exts[0] . "_s." . $exts[1];
} 


function TrimGet($p) {
	if (isset($_GET[$p])) {
		return trim($_GET[$p]);
	} else {
		return "";
	} 
} 
function RelativePath2RootPath($url) {
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
function RootPath2DomainPath($url) {
	$sProtocol = explode("/", $_SERVER["SERVER_PROTOCOL"]);
	$sHost = strtolower($sProtocol[0]) . "://" . $_SERVER["HTTP_HOST"];
	$sPort = $_SERVER["SERVER_PORT"];
	if ($sPort != "80") {
		$sHost = $sHost . ":" . $sPort;
	} 
	return $sHost . $url;
} 

function ReplaceRemoteUrl($sHTML, $sExt) {
	$s_Content = $sHTML;
	$s_Match = "/(http|https|ftp|rtsp|mms):(\/\/|\\\\){1}(([A-Za-z0-9_-])+[.]){1,}([A-Za-z0-9]{1,5})\/(\S+\.(" . $sExt . "))/i";
	if (!preg_match_all($s_Match, $s_Content, $a_Matches)) {
		return $s_Content;
	} ;
	for ($i = 0; $i < count($a_Matches[0]); $i++) {
		$a_RepeatRemote[] = $a_Matches[0][$i];
	} 
	$a_RemoteUrl = array_unique($a_RepeatRemote);
	$nFileNum = 0;
	for ($i = 0; $i < count($a_RemoteUrl); $i++) {
		$SaveFileType = substr($a_RemoteUrl[$i], strrpos($a_RemoteUrl[$i], ".") + 1);
		$SaveFileName = "R_" & GetRndFileName($SaveFileType);
		if (SaveRemoteFile($SaveFileName, $a_RemoteUrl[$i])) {
			$nFileNum = $nFileNum + 1;
			if ($nFileNum > 1) {
				$GLOBALS["cFileName"] .= "|";
				$GLOBALS["sFileName"] .= "|";
				$GLOBALS["sPathFileName"] .= "|";
			} 
			$GLOBALS["cFileName"] .= substr($a_RemoteUrl[i], strrpos($a_RemoteUrl[i], "/") + 1);
			$GLOBALS["sFileName"] .= $SaveFileName;
			$GLOBALS["sPathFileName"] .= $GLOBALS["sContentPath"] . $SaveFileName;
			$s_Content = str_replace($a_RemoteUrl[$i], $GLOBALS["sContentPath"] . $SaveFileName, $s_Content);
		} 
	} 
	return $s_Content;
} 
function SaveRemoteFile($s_LocalFileName, $s_RemoteFileUrl) {
	$fp = @fopen($s_RemoteFileUrl, "rb");
	if (!$fp) {
		return false;
	} 
	$cont = "";
	while (!feof($fp)) {
		$cont .= fread($fp, 2048);
	} 
	fclose($fp);
	if (strlen($cont) > $GLOBALS["sMaxsize"] * 1024) {
		return false;
	} 
	$fp2 = @fopen($GLOBALS["UpPath"] . $s_LocalFileName, "w");
	fwrite($fp2, $cont);
	fclose($fp2);
	return true;
} 

function GetRndFileName($sExt) {
	return date("YmdHis") . rand(10000000, 99999999) . "." . $sExt;
} 

function GetDateFileName(){
	return date("YmdHis") . rand(1000000, 9999999) . rand(1000, 9999);
}

function inHTML($str){
	$sTemp = $str;
	if(!$sTemp) return "";
	$sTemp = str_replace("&", "&amp;", $sTemp);
	$sTemp = str_replace("<", "&lt;", $sTemp);
	$sTemp = str_replace(">", "&gt;", $sTemp);
	$sTemp = str_replace(chr(34), "&quot;", $sTemp);
	return $sTemp;
}

?>