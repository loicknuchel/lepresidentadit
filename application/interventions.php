<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

$counts = getCounts();
$sourceTypes = getSourceTypes();
$engagementCategories = getEngagementCategory();
$citationCategories = getCitationCategory();
$interventionTypes = getInterventionTypes();
$interventions = getInterventions();
$engagements = getEngagements();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Interventions - Le président à dit..."); ?>
</head>
<body>
  <?php echo createHeader("interventions", $counts); ?>
	
  <div class="container">
    <?php
      if($errorMessage != null && $errorMessage != ''){
        echo '<div class="alert alert-block alert-error fade in">
          <button class="close" data-dismiss="alert">&times;</button>
          <strong>Oups!</strong> '.$errorMessage.'
        </div>';
      }
      /*echo $errorMessage;
      echo '<pre>';
      print_r($_POST);
      echo '</pre>';*/
    ?>
    <div class="row title">
      <div class="span12">
        <h1>Interventions</h1>
      </div>
    </div>
    <div class="row newElt">
      <div class="span12">
        <div class="button">
          <?php echo newInterventionModal('modalAddIntervention', $interventionTypes, $sourceTypes); ?>
          <a data-toggle="modal" href="#modalAddIntervention" class="btn">Nouvelle intervention</a>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="row datas">
      <div class="span12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>intervention</th>
              <th>sources</th>
              <th>engagements</th>
              <th>citations</th>
              <th>type</th>
              <!--<th>date</th>-->
            </tr>
          </thead>
          <tbody>
            <?php
              $count = 1;
              foreach($interventions as $key => $intervention){
                echo '<tr>
                  <th>'.$count.'</th>
                  <td><span class="js-tooltip" title="'.$intervention['type'].' du '.$intervention['date'].'">'.$intervention['name'].'</span></td>
                  <td>
                    '.newSourceModal('modalSource'.$intervention['id'], $sourceTypes, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn" data-toggle="dropdown">'.($intervention['sourcesNb'] == 0 ? "Pas de sources" : $intervention['sourcesNb'].' source'.($intervention['sourcesNb'] > 1 ? 's' : '')).'</button>
                      <button class="btn dropdown-toggle" data-toggle="modal" href="#modalSource'.$intervention['id'].'"><i class="icon-plus"></i></button>
                      <ul class="dropdown-menu">'; 
                        foreach($intervention['sources'] as $sourceKey => $source){
                          echo '<li><a href="'.$source['link'].'">'.$source['name'].' ('.$source['type'].')</a></li>';
                        }
                      echo '</ul>
                    </div>
                  </td>
                  <td>
                    '.newEngagementInterventionModal('modalEngagement'.$intervention['id'], $engagements, $engagementCategories, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn"><a href="intervention.php?intervention='.$intervention['id'].'">'.($intervention['engagementsNb'] == 0 ? "Pas d'engagements" : $intervention['engagementsNb'].' engagement'.($intervention['engagementsNb'] > 1 ? 's' : '')).'</a></button>
                      <button class="btn dropdown-toggle" data-toggle="modal" href="#modalEngagement'.$intervention['id'].'"><i class="icon-plus"></i></button>
                    </div>
                  </td>
                  <td>
                    '.addCitationModal('modalAddCitation'.$intervention['id'], $citationCategories, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn"><a href="intervention.php?intervention='.$intervention['id'].'">'.($intervention['citationNb'] == 0 ? "Pas de citations" : $intervention['citationNb'].' citation'.($intervention['citationNb'] > 1 ? 's' : '')).'</a></button>
                      <button class="btn dropdown-toggle" data-toggle="modal" href="#modalAddCitation'.$intervention['id'].'"><i class="icon-plus"></i></button>
                    </div>
                  </td>
                  <td class="type">'.$intervention['type'].'</td>
                  <!--<td>'.$intervention['date'].' à '.$intervention['heure'].'</td>-->
                </tr>';
                $count++;
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <?php //echo '<pre>';print_r($interventions);echo '</pre>';?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
