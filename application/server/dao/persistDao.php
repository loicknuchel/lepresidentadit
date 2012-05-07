<?php
include_once 'server/dao/connectDb.php';
include_once 'server/dao/mysqlUtils.php';

function daoPersistNewIntervention($interventionName, $interventionDate, $interventionTypeId){
  dbConnect(getStatus());
  $req = "INSERT INTO `".prefix()."intervention` (`interventionType`, `name`, `date`) VALUES (".$interventionTypeId.", ".nullSafe($interventionName).", ".nullSafe($interventionDate).");";
  $persistRes = persistQuery($req);
  if($persistRes == true){$res = mysql_insert_id();}
  else{$res = -1;}
  dbDisconnect();
  return $res;
}

function daoPersistNewSource($interventionId, $sourceName, $sourceLink, $sourceTypeId){
  dbConnect(getStatus());
  $req = "INSERT INTO `".prefix()."source` (`intervention`, `sourceType`, `title`, `link`) VALUES (".$interventionId.", ".$sourceTypeId.", ".nullSafe($sourceName).", ".nullSafe($sourceLink).");";
  $persistRes = persistQuery($req);
  if($persistRes == true){$res = mysql_insert_id();}
  else{$res = -1;}
  dbDisconnect();
  return $res;
}

function daoPersistNewEngagement($engagementCategoryId, $engagementTitle, $engagementContent){
  dbConnect(getStatus());
  $req = "INSERT INTO `".prefix()."engagement` (`engagementCategory`, `title`, `content`) VALUES (".$engagementCategoryId.", ".nullSafe($engagementTitle).", ".nullSafe($engagementContent).");";
  $persistRes = persistQuery($req);
  if($persistRes == true){$res = mysql_insert_id();}
  else{$res = -1;}
  dbDisconnect();
  return $res;
}

function daoPersistNewInterventionEngagement($interventionId, $engagementId, $originalText, $sourceLink, $interventionPos){
  dbConnect(getStatus());
  $req = "INSERT INTO `".prefix()."interventionHasEngagement` (`interventionId`, `engagementId`, `originalText`, `specificLink`, `interventionPos`) VALUES (".$interventionId.", ".$engagementId.", ".nullSafe($originalText).", ".nullSafe($sourceLink).", ".nullSafe($interventionPos).");";
  $persistRes = persistQuery($req);
  if($persistRes == true){$res = mysql_insert_id();}
  else{$res = -1;}
  dbDisconnect();
  return $res;
}

function daoPersistNewCitation($interventionId, $citationCategory, $citation, $citationPos, $citationLink){
  dbConnect(getStatus());
  $req = "INSERT INTO `".prefix()."citation` (`intervention`, `citationCategory`, `content`, `citationPos`, `specificLink`) VALUES (".$interventionId.", ".$citationCategory.", ".nullSafe($citation).", ".nullSafe($citationPos).", ".nullSafe($citationLink).");";
  $persistRes = persistQuery($req);
  if($persistRes == true){$res = mysql_insert_id();}
  else{$res = -1;}
  dbDisconnect();
  return $res;
}

?>