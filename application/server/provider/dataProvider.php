<?php
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

?>