<?php
include_once 'server/dao/connectDb.php';

function safe_string($entree){
	if(isset($entree) == 1){
		dbConnect(getStatus());
		$entree = mysql_real_escape_string($entree);
		dbDisconnect();
		return utf8_decode($entree);
	}
	return null;
}

function safe_int($entree){
	if(isset($entree) && is_numeric($entree)){
		return (int) intval($entree);
	}
	return null;
}

function safe_float($entree){
	if(isset($entree) == 1 && is_float($entree) == 0){
		return (float) $entree;
	}
	return null;
}

function safe_print($entree){
	dbConnect(getStatus());
	$ret = mysql_real_escape_string($entree);
	dbDisconnect();
	return $ret;
}

function safe_string_tab($tableau, $key){
	if(isset($tableau) == 1){
		$ret = array();
		foreach($tableau as $index => $value){
			if(strncmp($key, $index, strlen($key)) == 0){
				$ret[str_replace($key, "", $index)] = safe_string($value);
			}
		}
		return $ret;
	}
}

function safe_int_tab($tableau, $key){
	if(isset($tableau) == 1){
		$ret = array();
		foreach($tableau as $index => $value){
			if(strncmp($key, $index, strlen($key)) == 0){
				$ret[str_replace($key, "", $index)] = safe_int($value);
			}
		}
		return $ret;
	}
}

function safe_float_tab($tableau, $key){
	if(isset($tableau) == 1){
		$ret = array();
		foreach($tableau as $index => $value){
			if(strncmp($key, $index, strlen($key)) == 0){
				$ret[str_replace($key, "", $index)] = safe_float($value);
			}
		}
		return $ret;
	}
}

function html_format($string){
	$string = str_replace("\\r\\n", "<br/>", $string);
	$string = str_replace("\\n", "<br/>", $string);
	$string = str_replace("\\r", "", $string);
	$string = str_replace("\\", "", $string);
	
	return $string;
}

function unescape_string($string){
	$string = stripslashes($string);
	$string = str_replace("\\\\\\\\r\\\\\\\\n", "\r\n", $string);
	$string = str_replace("\\\\r\\\\n", "\r\n", $string);
	$string = str_replace("\\r\\n", "\r\n", $string);
	
	return $string;
}

?>
