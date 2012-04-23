<?php
include_once 'server/dao/retrieveDao.php';

function getStatus(){ return "LOCAL"; }

function getSourceTypes(){
  return daoGetSourceTypes();
}

function getInterventionTypes(){
  return daoGetInterventionTypes();
}

function getInterventions(){
  return daoGetInterventions();
}

?>