<?php
include_once 'server/dao/connectDb.php';

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

function daoGetEngagementCategory(){
  dbConnect(getStatus());
  
  $req = "SELECT id, name FROM ".prefix()."engagementCategory ORDER BY ordre;";
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
  
  $req = "SELECT i.id, it.name as type, i.name, i.date, IF(ihe.interventionId IS NOT NULL, count(s.id), 0) as engagementNb, s.id as sourceId, s.title as sourceName, s.link as sourceLink, st.name as sourceType
FROM ".prefix()."intervention i
LEFT OUTER JOIN ".prefix()."interventionType it ON it.id = i.interventionType
LEFT OUTER JOIN ".prefix()."source s ON s.intervention = i.id
LEFT OUTER JOIN ".prefix()."sourceType st ON st.id = s.sourceType
LEFT OUTER JOIN ".prefix()."interventionHasEngagement ihe ON ihe.interventionId=i.id
GROUP BY s.id
ORDER BY i.date DESC";

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
      $ret[$index]["date"] = dateFormat(decode($data['date']));
      $ret[$index]["heure"] = heureFormat(decode($data['date']));
      $ret[$index]["engagementNb"] = decode($data['engagementNb']);
      $ret[$index]["sources"][$srcIndex]["name"] = decode($data['sourceName']);
      $ret[$index]["sources"][$srcIndex]["link"] = decode($data['sourceLink']);
      $ret[$index]["sources"][$srcIndex]["type"] = decode($data['sourceType']);
      $ret[$index]["sourcesNb"] = $srcIndex+1;
    } else {
      $srcIndex++;
      $ret[$index]["sources"][$srcIndex]["name"] = decode($data['sourceName']);
      $ret[$index]["sources"][$srcIndex]["link"] = decode($data['sourceLink']);
      $ret[$index]["sources"][$srcIndex]["type"] = decode($data['sourceType']);
      $ret[$index]["sourcesNb"] = $srcIndex+1;
    }
	}
  
  dbDisconnect();
	return $ret;
}

function daoGetEngagements(){
  dbConnect(getStatus());
  
  $req = "SELECT e.id, ec.name as category, e.content, i.name as interventionName, it.name as interventionType, ihe.originalText as interventionContent, ihe.interventionPos, ihe.specificLink as interventionLink, i.date as interventionDate
FROM lpad_engagement e
LEFT OUTER JOIN lpad_engagementCategory ec ON ec.id=e.engagementCategory
LEFT OUTER JOIN lpad_interventionHasEngagement ihe ON ihe.engagementId=e.id
LEFT OUTER JOIN lpad_intervention i ON i.id=ihe.interventionId
LEFT OUTER JOIN lpad_interventionType it ON it.id=i.interventionType
ORDER BY e.engagementCategory";

  $result = mysql_query($req);
	$ret = array();
	$index = -1;
  $curId = -1;
  $interventionIndex = 0;
	while($result != null && $data = mysql_fetch_array($result, MYSQL_ASSOC)){
    if($curId == -1 || $curId != decode($data['id'])){
      $curId = decode($data['id']);
      $index++;
      $interventionIndex = 0;
      $ret[$index]["id"] = decode($data['id']);
      $ret[$index]["category"] = decode($data['category']);
      $ret[$index]["content"] = decode($data['content']);
      $ret[$index]["interventions"][$interventionIndex]["name"] = decode($data['interventionName']);
      $ret[$index]["interventions"][$interventionIndex]["type"] = decode($data['interventionType']);
      $ret[$index]["interventions"][$interventionIndex]["content"] = decode($data['interventionContent']);
      $ret[$index]["interventions"][$interventionIndex]["date"] = dateFormat(decode($data['interventionDate']));
      $ret[$index]["interventions"][$interventionIndex]["heure"] = heureFormat(decode($data['interventionDate']));
      $ret[$index]["interventions"][$interventionIndex]["link"] = decode($data['interventionLink']);
      $ret[$index]["interventions"][$interventionIndex]["position"] = decode($data['interventionPos']);
      $ret[$index]["interventionsNb"] = $interventionIndex+1;
    } else {
      $interventionIndex++;
      $ret[$index]["interventions"][$interventionIndex]["name"] = decode($data['interventionName']);
      $ret[$index]["interventions"][$interventionIndex]["type"] = decode($data['interventionType']);
      $ret[$index]["interventions"][$interventionIndex]["content"] = decode($data['interventionContent']);
      $ret[$index]["interventions"][$interventionIndex]["date"] = dateFormat(decode($data['interventionDate']));
      $ret[$index]["interventions"][$interventionIndex]["heure"] = heureFormat(decode($data['interventionDate']));
      $ret[$index]["interventions"][$interventionIndex]["link"] = decode($data['interventionLink']);
      $ret[$index]["interventions"][$interventionIndex]["position"] = decode($data['interventionPos']);
      $ret[$index]["interventionsNb"] = $interventionIndex+1;
    }
	}
  
  dbDisconnect();
	return $ret;
}


?>