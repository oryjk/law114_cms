	function idcode($field, $value, $fieldinfo) {
		extract($fieldinfo);
		$setting = string2array($setting);
		$size = $setting['size'];
		$errortips = $this->fields[$field]['errortips'];
		$regexp = $pattern ? '.regexValidator({regexp:"'.substr($pattern,1,-1).'",onerror:"'.$errortips.'"})' : '';
		if($errortips) $this->formValidator .= '$("#'.$field.'").formValidator({onshow:"'.$errortips.'",onfocus:"'.$errortips.'"}).inputValidator({min:'.$minlength.',max:'.$maxlength.',onerror:"'.$errortips.'"})'.$regexp.';';
        $imgpath="/idcodeBulider.php?".rand();
        $yzm='<label id="showtip" for="'.$field.'"></label><br/><img id="yzm" src="'.$imgpath.'" onclick="reloadcode()"/><script language="JavaScript">function checkyzm(){var yzm=document.getElementById("'.$field.'").value;$.post("/idcodeBulider.php?check=true",{yzmcode:yzm},function(msg){if(msg==1){document.getElementById("dosubmit").disabled=false;document.getElementById("showtip").style.color="green";document.getElementById("showtip").innerHTML="验证通过";}else{document.getElementById("showtip").style.color="red";document.getElementById("showtip").innerHTML="验证失败";}});}function reloadcode(){var verify=document.getElementById("yzm");verify.setAttribute("src","/idcodeBulider.php?"+Math.random());}</script>';
        return '<input type="text" name="info['.$field.']" id="'.$field.'" onblur="checkyzm()" class="input-text" style=width: 30%; data-role="none">'.$yzm;
	}
