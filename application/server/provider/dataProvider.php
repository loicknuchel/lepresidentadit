<?php
include_once 'server/utils/stringSecure.php';
include_once 'server/utils/stringUtils.php';
include_once 'server/dao/persistDao.php';
include_once 'server/dao/retrieveDao.php';

function getStatus(){ return "LOCAL"; }

function getSourceTypes(){
  return daoGetSourceTypes();
}

function getInterventionTypes(){
  return daoGetInterventionTypes();
}

function getEngagementCategory(){
  return daoGetEngagementCategory();
}

function getCitationCategory(){
  return daoGetCitationCategory();
}

function getInterventions(){
  return daoGetInterventions();
}

function getEngagements(){
  return daoGetEngagements();
}

function getCitations(){
  return daoGetCitations();
}

function getInterventionEngagements($_interventionId){
  if(isset($_interventionId) && is_id($_interventionId)){
    $interventionId = safe_string($_interventionId);
    $interventionArray = daoGetIntervention($interventionId);
    
    if(is_array($interventionArray) && isset($interventionArray[0])){
      $intervention = $interventionArray[0];
      
      $interventionEngagementsArray = daoGetInterventionEngagements($interventionId);
      if(is_array($interventionEngagementsArray) && isset($interventionEngagementsArray[0])){
        $intervention['engagements'] = $interventionEngagementsArray;
      } else {
        $intervention['engagements'] = null;
      }
      
      $intervention['citations'] = daoGetInterventionCitations($interventionId);
      
      return $intervention;
    }
    
  }
  return null;
}

function getEngagementInterventions($_engagementId){
  if(isset($_engagementId) && is_id($_engagementId)){
    $engagementId = safe_string($_engagementId);
    $engagementArray = daoGetEngagement($engagementId);
    
    $engagement = $engagementArray;
    return $engagement;
  }
  return null;
}

function getCounts(){
  return daoCountAll();
}

function addIntervention($interventionName, $interventionDate, $interventionTypeId, $sourceName, $sourceLink, $sourceTypeId){
  $interventionId = daoPersistNewIntervention($interventionName, $interventionDate, $interventionTypeId);
  if($interventionId > 0){
    $sourceId = daoPersistNewSource($interventionId, $sourceName, $sourceLink, $sourceTypeId);
    if($sourceId <= 0){
      return "Error when try to register intervetion source (".$sourceId.")";
    }
  } else {
    return "Error when try to register intervetion (".$interventionId.")";
  }
  return null;
}

function addSource($interventionId, $sourceName, $sourceLink, $sourceTypeId){
  $sourceId = daoPersistNewSource($interventionId, $sourceName, $sourceLink, $sourceTypeId);
  if($sourceId <= 0){
    return "Error when try to register intervetion source (".$sourceId.")";
  } else {
    return null;
  }
}

function addEngagementIntervention($interventionId, $originalText, $specificLink, $interventionPos, $engagementId, $engagementCategoryId, $engagementTitle, $engagementContent){
  // si l'engagement n'existe pas, on le crée
  if(!is_id($engagementId)){
    $engagementId = daoPersistNewEngagement($engagementCategoryId, $engagementTitle, $engagementContent);
    if($engagementId <= 0){
      return "Error when try to register engagement (".$engagementId.")";
    }
  }
  
  $interventionEngagementId = daoPersistNewInterventionEngagement($interventionId, $engagementId, $originalText, $specificLink, $interventionPos);
  if($interventionEngagementId <= 0){
    return "Error when try to register intervetion engagement (".$interventionEngagementId.")";
  } else {
    return null;
  }
}

function addEngagement($engagementCategoryId, $engagementTitle, $engagementDesc){
  $engagementId = daoPersistNewEngagement($engagementCategoryId, $engagementTitle, $engagementDesc);
  if($engagementId <= 0){
    return "Error when try to register engagement (".$engagementId.")";
  } else {
    return null;
  }
}

function addInterventionEngagement($engagementId, $originalText, $specificLink, $interventionPos, $interventionId, $interventionName, $interventionDate, $interventionTypeId, $sourceName, $sourceLink, $sourceTypeId){
  // si l'intervention n'existe pas, on la crée
  if(!is_id($interventionId)){
    $interventionId = daoPersistNewIntervention($interventionName, $interventionDate, $interventionTypeId);
    if($interventionId > 0){
      $sourceId = daoPersistNewSource($interventionId, $sourceName, $sourceLink, $sourceTypeId);
      if($sourceId <= 0){
        return "Error when try to register intervetion source (".$sourceId.")";
      }
    } else {
      return "Error when try to register intervetion (".$interventionId.")";
    }
  }
  
  $interventionEngagementId = daoPersistNewInterventionEngagement($interventionId, $engagementId, $originalText, $specificLink, $interventionPos);
  if($interventionEngagementId <= 0){
    return "Error when try to register intervetion engagement (".$interventionEngagementId.")";
  } else {
    return null;
  }
}

function addCitation($citationCategoryId, $citation, $citationPos, $citationLink, $interventionId, $interventionName, $interventionDate, $interventionTypeId, $sourceName, $sourceLink, $sourceTypeId){
  // si l'intervention n'existe pas, on la crée
  if(!is_id($interventionId)){
    $interventionId = daoPersistNewIntervention($interventionName, $interventionDate, $interventionTypeId);
    if($interventionId > 0){
      $sourceId = daoPersistNewSource($interventionId, $sourceName, $sourceLink, $sourceTypeId);
      if($sourceId <= 0){
        return "Error when try to register intervetion source (".$sourceId.")";
      }
    } else {
      return "Error when try to register intervetion (".$interventionId.")";
    }
  }
  
  $citationId = daoPersistNewCitation($interventionId, $citationCategoryId, $citation, $citationPos, $citationLink);
  if($citationId <= 0){
    return "Error when try to register citation (".$citationId.")";
  } else {
    return null;
  }
}

function addCitationEngagement($interventionId, $citationCategoryId, $citation, $citationPos, $citationLink){
  $citationId = daoPersistNewCitation($interventionId, $citationCategoryId, $citation, $citationPos, $citationLink);
  if($citationId <= 0){
    return "Error when try to register citation engagement (".$citationId.")";
  } else {
    return null;
  }
}

?>