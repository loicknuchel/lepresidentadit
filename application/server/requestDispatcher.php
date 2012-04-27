<?php
include_once 'server/utils/stringSecure.php';
include_once 'server/utils/stringUtils.php';
include_once 'server/provider/dataProvider.php';

function dispatchRequest($POST, $GET){
  foreach($POST as $key => $value){
    $POST[$key] = safe_string($value);
  }
  foreach($GET as $key => $value){
    $GET[$key] = safe_string($value);
  }
  
  if(count($POST) == 4 && checkNewSource($POST)){
    return true;
  } else if(count($POST) == 6 && checkNewIntervention($POST)){
    return true;
  } else if(count($POST) == 7 && checkNewEngagement($POST)){
    return true;
  }
  return false;
}

// private
    // TODO : coder is_url, is_date et is_datetime !!!
function checkNewIntervention($req){
  if(isset($req['intervention']) && isset($req['interventionDate']) && isset($req['interventionType']) && isset($req['sourceName']) && isset($req['sourceLink']) && isset($req['sourceType'])){
    if(!empty($req['intervention']) && is_date($req['interventionDate']) && is_id($req['interventionType']) && !empty($req['sourceName']) && is_url($req['sourceLink']) && is_id($req['sourceType'])){
      addIntervention($req['intervention'], $req['interventionDate'], $req['interventionType'], $req['sourceName'], $req['sourceLink'], $req['sourceType']);
    }
    return true;
  }
  return false;
}

function checkNewSource($req){
  if(isset($req['interventionId']) && isset($req['sourceName']) && isset($req['sourceLink']) && isset($req['sourceType'])){
    if(is_id($req['interventionId']) && !empty($req['sourceName']) && is_url($req['sourceLink']) && is_id($req['sourceType'])){
      addIntervention($req['interventionId'], $req['sourceName'], $req['sourceLink'], $req['sourceType']);
    }
    return true;
  }
  return false;
}

function checkNewEngagement($req){
  if(isset($req['interventionId']) && isset($req['originalText']) && isset($req['sourceLink']) && isset($req['interventionPos']) && isset($req['engagementRef']) && isset($req['engagementCategory']) && isset($req['engagementDesc'])){
    if(is_id($req['interventionId']) && !empty($req['originalText']) && is_url($req['sourceLink']) && !empty($req['interventionPos']) && (is_id($req['engagementRef']) || (is_id($req['engagementCategory']) && !empty($req['engagementDesc'])))){
      addEngagement($req['interventionId'], $req['originalText'], $req['sourceLink'], $req['interventionPos'], $req['engagementRef'], $req['engagementCategory'], $req['engagementDesc']);
    }
    return true;
  }
  return false;
}

?>