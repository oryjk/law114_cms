<?php
header("Content-Type: text/html;charset=utf-8");

require("config.php");

InitParam();

switch($GLOBALS["action"]){
	case "folder": 
		GetFolderList($GLOBALS["sCurrDir"]); break;
	case "file": 
		GetFileList($GLOBALS["sCurrDir"]); break;
}

function InitParam(){

	global $action, $sType, $sStyleName, $cusdir;
	global $foldertype, $returnflag;
	global $sCurrDir, $sDir;
	global $sAllowExt, $sUploadDir, $sBaseUrl, $sContentPath, $nAllowBrowse;

	$action = strtolower(TrimGet("action"));
	$sType = strtolower(TrimGet("type"));
	$sStyleName = strtolower(TrimGet("style"));
	$sDir = TrimGet("dir");
	if($sDir=="" && isset($_POST["dir"])) $sDir = Trim($_POST["dir"]);
	$cusdir = TrimGet("cusdir");
	$foldertype = TrimGet("foldertype");
	$returnflag = TrimGet("returnflag");

	

	$bValidStyle = false;
	$Mystyle = $GLOBALS["Mystyle"];
	
	for ($i=0;$i<count($Mystyle);$i++){
		If (strtolower($sStyleName) == strtolower($Mystyle[$i][0][0])){
			$aStyleConfig = $Mystyle[$i][0];
			$bValidStyle = True;
			break;
		}
	}


	If (!$bValidStyle){
		OutScript("alert('Invalid Style.')");
	}

	$sBaseUrl = $aStyleConfig[24];

	$nAllowBrowse = $aStyleConfig[22];
	
	If ($nAllowBrowse != 1){
		OutScript("alert('Do not allow browse!')");
	}

	$sUploadDir = $aStyleConfig[25];


	switch (strtoupper($sType)){
		case "IMAGE":
			$sUploadDir .= "Image/"; break;
		case "FLASH":
			$sUploadDir .= "Flash/"; break;
		case "MEDIA":
			$sUploadDir .= "Media/"; break;
		case "FILE":
			$sUploadDir .= "Other/"; break;
	}
	
	If ($action=="file"){ 
		switch (strtolower($foldertype)){
			case "shareimage":
				$sUploadDir = "sharefile/Image/"; break;
			case "shareflash":
				$sUploadDir = "sharefile/flash/"; break;
			case "sharemedia":
				$sUploadDir = "sharefile/media/"; break;
			case "shareother":
				$sUploadDir = "sharefile/other/"; break;
		}
	}

	$sCurrDir = $sUploadDir;
	If (substr($sCurrDir,0,1)!= "/"){
	   $sCurrDir = "../" . $sCurrDir;
	}
	$sDir = str_replace("\\", "/", $sDir);
	$sDir = str_replace("../", "", $sDir);
	$sDir = str_replace("./", "", $sDir);
	If ($sDir != ""){
		If (file_exists($sCurrDir . $sDir)){
			$sCurrDir = $sDir . "/";
			$sCurrDir = str_replace("//","/",$sCurrDir);
		}else{
			$sDir = "";
		}
	}
}


function GetFileList($s_CurrDir){
	//die($s_CurrDir);
    //echo $s_CurrDir;
	echo "<HTML>" . "\n\r";
	echo "<HEAD>" . "\n\r";
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" . "\n\r";
	echo "<TITLE>eWebEditor</TITLE>" . "\n\r";
	echo "</head>" . "\n\r";
	echo "<body>" . "\n\r";
	echo "<script language='javascript' type='text/javascript'>" . "\n\r";
	echo "var arr = new Array();" . "\n\r";

	if (is_dir($s_CurrDir)){
		if ($handle = opendir($s_CurrDir)) {
			while (false !== ($file = readdir($handle))) {
				$sFileType = filetype($s_CurrDir.$file);
				if ($sFileType=="file"){
					$oFiles[] = $file;
				}
			}
		}
		
		if (isset($oFiles)){
			$i = 0;
			foreach($oFiles as $oFile){
				$sFileName = $s_CurrDir . $oFile;
				echo "arr[" . $i . "]=new Array(\"" . $oFile . "\", \"" . GetSizeUnit(filesize($sFileName)) ."B\",\"" . date("Y-m-d H:i:s",filemtime($sFileName)) . "\");\n\r";
				$i++;
			}
		}
	}

	echo "parent.setFileList('" . $GLOBALS["returnflag"] . "', '" . $GLOBALS["foldertype"] . "', '" . $GLOBALS["sDir"] . "', arr);" . "\n\r";
	echo "</script>" . "\n\r";
	echo "</body>" . "\n\r";
	echo "</html>" . "\n\r";
}


function GetFolderList($s_CurrDir){

	echo "<HTML>" . "\n\r";
	echo "<HEAD>" . "\n\r";
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" . "\n\r";
	echo "<TITLE>eWebEditor</TITLE>" . "\n\r";
	echo "</head>" . "\n\r";
	echo "<body>" . "\n\r";
	echo "<script language='javascript' type='text/javascript'>" . "\n\r";
	echo "var arrUpload = new Array();" . "\n\r";
	echo "var arrShareImage = new Array();" . "\n\r";
	echo "var arrShareFlash = new Array();" . "\n\r";
	echo "var arrShareMedia = new Array();" . "\n\r";
	echo "var arrShareOther = new Array();" . "\n\r";

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
				echo "arrUpload[" . $i . "]=new Array(\"" . $oDir . "\",1, 0);" . "\n\r";
				$i++;
			}
		}

	}

	echo "parent.setFolderList(arrUpload, arrShareImage, arrShareFlash, arrShareMedia, arrShareOther);" . "\n\r";
	echo "</script>" . "\n\r";
	echo "</body>" . "\n\r";
	echo "</html>" . "\n\r";


} 


function OutScript($str){
	echo "<HTML><HEAD><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><TITLE>eWebEditor</TITLE></head><body>";
	echo "<script language=javascript>" . $str . "</script>";
	die("</body></html>");
}

function GetSizeUnit($n_Size){
	If ($n_Size >= 1024*1024){
		return number_format(($n_Size / 1024 / 1024), 2, ".", "") . "M";
	}else{
		return number_format(($n_Size / 1024), 2, ".", "") . "K";
	}
}

function TrimGet($p){
	if (isset($_GET[$p])){
		return trim($_GET[$p]);
	} else{
		return "";
	}
}

?>