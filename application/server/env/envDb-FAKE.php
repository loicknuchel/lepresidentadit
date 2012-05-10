<?php

function getStatus(){ return "LOCAL"; }

function setDbVars($status){
	$ret = "";
	if($status == "LOCAL"){
		$ret['host']="localhost";
		$ret['username']="root";
		$ret['password']="";
		$ret['DbName']="myBdName";
	} else if($status == "DEV"){
		$ret['host']="myHost";
		$ret['username']="me";
		$ret['password']="pass";
		$ret['DbName']="myDevDb";
	} else if($status == "PROD"){
		$ret['host']="myHost";
		$ret['username']="me";
		$ret['password']="pass";
		$ret['DbName']="myProdDb";
	} else{
		return null;
	}
	
	return $ret;
}

?>
