<?php
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

function getInterventions(){
  return daoGetInterventions();
}

function getEngagements(){
  return daoGetEngagements();
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

function addEngagement($interventionId, $originalText, $sourceLink, $interventionPos, $engagementId, $engagementCategoryId, $engagementContent){
  // si l'engagement n'existe pas, on le crée
  if(!is_id($engagementId)){
    $engagementId = daoPersistNewEngagement($engagementCategoryId, $engagementContent);
    if($engagementId <= 0){
      return "Error when try to register engagement (".$engagementId.")";
    }
  }
  
  $interventionEngagementId = daoPersistNewInterventionEngagement($interventionId, $engagementId, $originalText, $sourceLink, $interventionPos);
  if($interventionEngagementId <= 0){
    return "Error when try to register intervetion engagement (".$interventionEngagementId.")";
  } else {
    return null;
  }
  
}

?>