<?php
include_once 'server/utils/stringSecure.php';
include_once 'server/utils/stringUtils.php';
include_once 'server/provider/dataProvider.php';

function dispatchRequest($_POST, $_GET, &$errorMessage){
  $POST = array();
  $GET = array();
  foreach($_POST as $key => $value){
    $POST[$key] = safe_string($value);
  }
  foreach($_GET as $key => $value){
    $GET[$key] = safe_string($value);
  }
  
  if(count($POST) == 3 && checkNewEngagement($POST, $errorMessage)){
    return true;
  } else if(count($POST) == 4 && checkNewSource($POST, $errorMessage)){
    return true;
  } else if(count($POST) == 6 && checkNewIntervention($POST, $errorMessage)){
    return true;
  } else if(count($POST) == 8 && checkNewEngagementIntervention($POST, $errorMessage)){
    return true;
  } else if(count($POST) == 11 && checkNewInterventionEngagement($POST, $errorMessage)){
    return true;
  }
  //$errorMessage = 'pas de requetes';
  return false;
}

// private
    // TODO : coder is_url, is_date et is_datetime !!!
function checkNewIntervention($req, &$errorMessage){
  if(isset($req['intervention']) && isset($req['interventionDate']) && isset($req['interventionType']) && isset($req['sourceName']) && isset($req['sourceLink']) && isset($req['sourceType'])){
    if(!empty($req['intervention']) && is_date($req['interventionDate']) && is_id($req['interventionType']) && !empty($req['sourceName']) && is_url($req['sourceLink']) && is_id($req['sourceType'])){
      $errorMessage = addIntervention($req['intervention'], $req['interventionDate'], $req['interventionType'], $req['sourceName'], $req['sourceLink'], $req['sourceType']);
    } else {
      $errorMessage = "Some datas are incorrect";
    }
    return true;
  }
  return false;
}

function checkNewSource($req, &$errorMessage){
  if(isset($req['interventionId']) && isset($req['sourceName']) && isset($req['sourceLink']) && isset($req['sourceType'])){
    if(is_id($req['interventionId']) && !empty($req['sourceName']) && is_url($req['sourceLink']) && is_id($req['sourceType'])){
      $errorMessage = addSource($req['interventionId'], $req['sourceName'], $req['sourceLink'], $req['sourceType']);
    } else {
      $errorMessage = "Some datas are incorrect";
    }
    return true;
  }
  return false;
}

function checkNewEngagementIntervention($req, &$errorMessage){
  if(isset($req['interventionId']) && isset($req['originalText']) && isset($req['specificLink']) && isset($req['interventionPos']) && isset($req['engagementRef']) && isset($req['engagementCategory']) && isset($req['engagementTitle']) && isset($req['engagementDesc'])){
    if(is_id($req['interventionId']) && !empty($req['originalText']) && is_url($req['specificLink'], true) && !empty($req['interventionPos']) && (is_id($req['engagementRef']) || (is_id($req['engagementCategory']) && !empty($req['engagementTitle']) && !empty($req['engagementDesc'])))){
      $errorMessage = addEngagementIntervention($req['interventionId'], $req['originalText'], $req['specificLink'], $req['interventionPos'], $req['engagementRef'], $req['engagementCategory'], $req['engagementTitle'], $req['engagementDesc']);
    } else {
      $errorMessage = "Some datas are incorrect";
    }
    return true;
  }
  return false;
}

function checkNewEngagement($req, &$errorMessage){
  if(isset($req['engagementCategory']) && isset($req['engagementTitle']) && isset($req['engagementDesc'])){
    if(is_id($req['engagementCategory']) && !empty($req['engagementTitle']) && !empty($req['engagementDesc'])){
      $errorMessage = addEngagement($req['engagementCategory'], $req['engagementTitle'], $req['engagementDesc']);
    } else {
      $errorMessage = "Some datas are incorrect";
    }
    return true;
  }
  return false;
}

function checkNewInterventionEngagement($req, &$errorMessage){
  if(isset($req['engagementId']) && isset($req['originalText']) && isset($req['specificLink']) && isset($req['interventionPos']) && isset($req['interventionRef']) && isset($req['intervention']) && isset($req['interventionDate']) && isset($req['interventionType']) && isset($req['sourceName']) && isset($req['sourceLink']) && isset($req['sourceType'])){
    if(is_id($req['engagementId']) && !empty($req['originalText']) && is_url($req['specificLink'], true) && !empty($req['interventionPos']) && (is_id($req['interventionRef']) || (!empty($req['intervention']) && !empty($req['interventionDate']) && is_id($req['interventionType']) && !empty($req['sourceName']) && is_url($req['sourceLink']) && is_id($req['sourceType'])))){
      $errorMessage = addInterventionEngagement($req['engagementId'], $req['originalText'], $req['specificLink'], $req['interventionPos'], $req['interventionRef'], $req['intervention'], $req['interventionDate'], $req['interventionType'], $req['sourceName'], $req['sourceLink'], $req['sourceType']);
    } else {
      $errorMessage = "Some datas are incorrect";
    }
    return true;
  }
  return false;
}

?>