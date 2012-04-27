<?php
include_once 'server/env/envDb.php';

function dbConnect($status){
	// on se connecte à MySQL
	$dbVars = setDbVars($status);
	$db = mysql_connect($dbVars['host'], $dbVars['username'], $dbVars['password']);
	
	if(!$db){
		echo 'false';
		exit;
	}
	else{
		// on selectionne la base
		if(!mysql_select_db($dbVars['DbName'],$db)){
			echo '<h1>Erreur de selection de la base</h1>';
			exit;
		}
	}
	
	return $db;
}

function dbDisconnect(){
	mysql_close();
}

function dateFormat($dateTime){
  $dateArray = explode(" ", $dateTime);
  $date = $dateArray[0];
  $dateArray = explode("-", $date);
  $annee = $dateArray[0];
  $mois = $dateArray[1];
  $jour = $dateArray[2];
  return $jour.'/'.$mois.'/'.$annee;
}

function heureFormat($dateTime){
  $dateArray = explode(" ", $dateTime);
  $time = $dateArray[1];
  $timeArray = explode(":", $time);
  $heure = $timeArray[0];
  $minute = $timeArray[1];
  $seconde = $timeArray[2];
  return $heure.'h'.$minute;
}

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

?>
