<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xingyu
 * Date: 13-8-12
 * Time: 下午2:45
 * To change this template use File | Settings | File Templates.
 */
//常量
//更新服务器地址
$cmsupdatepath="http://rm.mb.cdbaidu.com/updatedata/";
//$cmsupdatepath="http://localhost/uploadf/";
//本地文件根目录
$webRoot=$_SERVER["DOCUMENT_ROOT"]."/";
//更新文件路径
$versionpath="update/version.txt";
//更新详细文件路径
$updateinfopath="/updateInfo";
$versioninfopath="versionInfo.txt";

$tool=new updateTool();
$updateToVersion=$_GET["ver"];
$nowVersion=$tool->readVersion($webRoot.$versionpath);
$versionInfo=$tool->readVersionInfo($cmsupdatepath.$versioninfopath,$updateToVersion,$nowVersion);

foreach($versionInfo as $value){
    //压缩文件更新方法
    $updateFileRoot=$cmsupdatepath.$value.".zip";
    $zipfile=$tool->httpcopy($updateFileRoot);
    $tool->unzip($zipfile,".././");
    unlink($zipfile);
}
$resultStr=$tool->readVersion($webRoot.$versionpath);
$ary = array('result'=>0,'message'=>$resultStr);
$json = json_encode($ary);
echo "json=$json;";
class updateTool{
    //读取升级配置文件
    function readVersionInfo($path,$toVersion,$nowVersion){
        $returnArray=array();
        $versions=split("\n",$this->readFileByUrlPath($path));
        foreach($versions as $value){
            $temp=split("&&&&",$value);
            if($temp[0]>=$toVersion){
                break;
            }
            if($temp[0]>=$nowVersion){
                array_push($returnArray,$temp[1]);
            }
        }
        return $returnArray;
    }
    //读取版本文件内容
    function readVersion($path){
        return $this->readFileByPath($path);
    }
//读取更新配置文件
    function readUpdateInfo($path){
        return split("\r\n",$this->readFileByUrlPath($path));
    }
//读取文件
    function readFileByPath($path){
        $fp = fopen($path,'r');
        $contents = fread ($fp, filesize ($path));
        fclose($fp);
        return $contents;
    }
//读取网络文件
    function readFileByUrlPath($path){
        return file_get_contents($path);
    }
// 原目录，复制到的目录
    function resource_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
//复制网络文件到本地
    function resource_copy_url($src,$dst) {
        $content=file_get_contents($src);
        file_put_contents($dst,$content);
    }

    //采集功能
    function httpcopy($url, $file="", $timeout=60) {
        $file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
        $dir = pathinfo($file,PATHINFO_DIRNAME);
        !is_dir($dir) && @mkdir($dir,0755,true);
        $url = str_replace(" ","%20",$url);

        if(function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $temp = curl_exec($ch);
            if(@file_put_contents($file, $temp) && !curl_error($ch)) {
                return $file;
            } else {
                return false;
            }
        } else {
//            $opts = array(
//                "http"=>array(
//                    "method"=>"GET",
//                    "header"=>"",
//                    "timeout"=>$timeout)
//            );
//            $context = stream_context_create($opts);
//            echo $url;
//            if(@copy($url, $file, $context)) {
//                //$http_response_header
//                return $file;
//            } else {
//                return false;
//            }
            $this->resource_copy_url($url,$file);
            return $file;
        }
    }

    //解压功能
    function unzip($zip_filename,$to_loc){
        set_time_limit(0);
        $zip_filename = key_exists('zip', $_GET) && $_GET['zip']?$_GET['zip']:$zip_filename;
        $zip_filepath = str_replace('\\', '/', dirname(__FILE__)) . '/' . $zip_filename;
        if(!is_file($zip_filepath))
        {
            return false;
        }
        $zip = new ZipArchive();
        $rs = $zip->open($zip_filepath);
        if($rs !== TRUE)
        {
            return false;
        }
        $zip->extractTo($to_loc);
        $zip->close();
        return true;
    }
}
?>