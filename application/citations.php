<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

$counts = getCounts();
$interventionTypes = getInterventionTypes();
$sourceTypes = getSourceTypes();
$engagementCategories = getEngagementCategory();
$citationCategories = getCitationCategory();
$interventions = getInterventions();
$engagements = getEngagements();
$citations = getCitations();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Citations - Le président à dit"); ?>
</head>
<body>
  <?php echo createHeader("citations", $counts); ?>
	
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
        <h1>Citations</h1>
      </div>
    </div>
    <div class="row newElt">
      <div class="span12">
        <div class="button">
          <?php echo newCitationModal('modalAddCitation', $citationCategories, $interventions, $interventionTypes, $sourceTypes); ?>
          <a data-toggle="modal" href="#modalAddCitation" class="btn">Nouvelle citation</a>
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
              <th>citation</th>
              <th>intervention</th>
              <th>référence exacte</th>
              <th>catégorie</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $count = 1;
              foreach($citations as $key => $citation){
                echo '<tr>
                  <th>'.$count.'</th>
                  <td>'.$citation['citation'].'</td>
                  <td>
                    <a class="btn js-tooltip" href="intervention.php?intervention='.$citation['interventionId'].'" title="'.$citation['interventionType'].' du '.$citation['interventionDate'].'">'.$citation['interventionName'].'</a>
                  </td>
                  <td>'.($citation['citationLink'] == null || $citation['citationLink'] == '' ? $citation['citationPos'] : '<a href="'.$citation['citationLink'].'">'.$citation['citationPos'].'</a>').'</td>
                  <td class="type">'.$citation['category'].'</td>
                </tr>';
                $count++;
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <?php //echo '<pre>';print_r($citations);echo '</pre>';?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
