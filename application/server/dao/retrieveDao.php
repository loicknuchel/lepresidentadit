<?php
include_once 'server/dao/connectDb.php';


function prefix(){
	return "LPAD_";
}
function encode($string){
	return $string;
	//return utf8_decode($string);
	//return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $string);
}
function decode($string){
	//return $string;
	return utf8_encode($string);
}

function daoGetSourceTypes(){
  dbConnect(getStatus());
  
  $req = "SELECT id, name FROM ".prefix()."sourceType;";
  $result = mysql_query($req);
	$ret = array();
	$index = 0;
	while($result != null && $data = mysql_fetch_array($result, MYSQL_ASSOC)){
		$ret[$index]["id"] = decode($data['id']);
		$ret[$index]["name"] = decode($data['name']);
		$index++;
	}
  
  dbDisconnect();
	return $ret;
}

function daoGetInterventionTypes(){
  dbConnect(getStatus());
  
  $req = "SELECT id, name FROM ".prefix()."interventionType;";
  $result = mysql_query($req);
	$ret = array();
	$index = 0;
	while($result != null && $data = mysql_fetch_array($result, MYSQL_ASSOC)){
		$ret[$index]["id"] = decode($data['id']);
		$ret[$index]["name"] = decode($data['name']);
		$index++;
	}
  
  dbDisconnect();
	return $ret;
}

function daoGetInterventions(){
  dbConnect(getStatus());
  
  $req = "SELECT i.id, it.name as type, i.name, i.date, s.title as sourceName, s.link as sourceLink, st.name as sourceType
FROM ".prefix()."intervention i
LEFT OUTER JOIN ".prefix()."interventionType it ON it.id = i.interventionType
LEFT OUTER JOIN ".prefix()."source s ON s.intervention = i.id
LEFT OUTER JOIN ".prefix()."sourceType st ON st.id = s.sourceType;";
  $result = mysql_query($req);
	$ret = array();
	$index = -1;
  $curId = -1;
  $srcIndex = 0;
	while($result != null && $data = mysql_fetch_array($result, MYSQL_ASSOC)){
    if($curId == -1 || $curId != decode($data['id'])){
      $curId = decode($data['id']);
      $index++;
      $srcIndex = 0;
      $ret[$index]["id"] = decode($data['id']);
      $ret[$index]["type"] = decode($data['type']);
      $ret[$index]["name"] = decode($data['name']);
      $ret[$index]["date"] = decode($data['date']);
      $ret[$index]["sources"][$srcIndex]["name"] = decode($data['sourceName']);
      $ret[$index]["sources"][$srcIndex]["link"] = decode($data['sourceLink']);
      $ret[$index]["sources"][$srcIndex]["type"] = decode($data['sourceType']);
    } else {
      $srcIndex++;
      $ret[$index]["sources"][$srcIndex]["name"] = decode($data['sourceName']);
      $ret[$index]["sources"][$srcIndex]["link"] = decode($data['sourceLink']);
      $ret[$index]["sources"][$srcIndex]["type"] = decode($data['sourceType']);
    }
	}
  
  dbDisconnect();
	return $ret;
}


?>