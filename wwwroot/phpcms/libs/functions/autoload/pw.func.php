<?php
function array_sort($arr,$keys,$type='asc'){ 
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[strtolower($keys)];
	}
	if(strtolower($type) == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
}
?>