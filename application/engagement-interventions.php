<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/utils/embed.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

$interventionTypes = getInterventionTypes();
$sourceTypes = getSourceTypes();
$interventions = getInterventions();
$engagementInterventions = getEngagementInterventions($_GET['engagement']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Le président à dit..."); ?>
</head>
<body>
  <?php echo createHeader("engagements", getCounts()); ?>
	
  <div class="container">
    <?php
      if($errorMessage != null && $errorMessage != ''){
        echo '<div class="alert alert-block alert-error fade in">
          <button class="close" data-dismiss="alert">&times;</button>
          <strong>Oups!</strong> '.$errorMessage.'
        </div>';
        /*echo '<pre>';
        print_r($_POST);
        echo '</pre>';*/
      }
    ?>
    <?php 
      if($engagementInterventions != null && $engagementInterventions != ''){ 
    ?>
    
        <div class="row">
          <div class="span12">
            <div class="hero-unit">
              <h1><?php echo $engagementInterventions['title']; ?></h1>
              <p><?php echo $engagementInterventions['content']; ?></p>
            </div>
          </div>
        </div>
        <br/>
        <br/>
        <div class="row">
          <div class="span12">
            <h2>Interventions traitant de cet engagement :</h2>
            <?php 
              echo newInterventionEngagementModal('modalIntervention'.$engagementInterventions['id'], $interventions, $interventionTypes, $sourceTypes, $engagementInterventions['id'], $engagementInterventions['title'])
                .'<a class="btn" data-toggle="modal" href="#modalIntervention'.$engagementInterventions['id'].'">Ajouter à une intervention</a>'; 
            ?>
            
            <?php
              if($engagementInterventions['interventions'] != null && $engagementInterventions['interventions'] != ''){
                echo '<table class="table table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>type</th>
                    <th>intervention</th>
                    <th>citation exacte</th>
                    <th>référence exacte</th>
                  </tr>
                  </thead>
                  <tbody>';
                  $index = 1;
                  foreach($engagementInterventions['interventions'] as $key => $intervention){
                    echo '<tr>
                      <td>'.$index.'</td>
                      <td>'.$intervention['type'].'</td>
                      <td><span class="js-tooltip" title="le '.$intervention['date'].'">'.$intervention['name'].'</span></td>
                      <td>'.$intervention['content'].'</td>
                      <td>'.($intervention['link'] == null || $intervention['link'] == '' ? $intervention['position'] : '<a href="'.$intervention['link'].'">'.$intervention['position'].'</a>').'</td>
                    </tr>';
                    $index++;
                  }
                  echo '</tbody>
                </table>';
              }
            ?>
          </div>
        </div>
        
        <?php //echo '<pre>';print_r($engagementInterventions);echo '</pre>';?>
    <?php 
      }
    ?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
