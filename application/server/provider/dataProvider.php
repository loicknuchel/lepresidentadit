<?php
include_once 'server/utils/stringUtils.php';
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

function addIntervention($interventionName, $interventionDate, $interventionType, $sourceName, $sourceLink, $sourceType){
  
}

function addSource($interventionId, $sourceName, $sourceLink, $sourceType){
  
}

function addEngagement($interventionId, $originalText, $sourceLink, $interventionPos, $engagementId, $engagementCategoryId, $engagementContent){
  if(is_id($engagementId)){
  
  } else {
  
  }
}

?>