<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/utils/embed.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

/*$interventionTypes = getInterventionTypes();

$interventions = getInterventions();
$engagements = getEngagements();*/
$sourceTypes = getSourceTypes();
$interventionEngagements = getInterventionEngagements($_GET['intervention']);
$engagementCategories = getEngagementCategory();
$engagements = getEngagements();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Le président à dit..."); ?>
</head>
<body>
  <?php echo createHeader("interventions"); ?>
	
  <div class="container">
    <?php 
      if($interventionEngagements != null && $interventionEngagements != ''){ 
    ?>
    
        <div class="row">
          <div class="span12">
            <h1><?php echo $interventionEngagements['type'].' : '.$interventionEngagements['name']; ?></h1>
            <a href="interventions.php" class="btn">Retour</a>
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="span8">
            <?php
              $selectedSource = null;
              if(false){
              
              } else if(isSourceType($interventionEngagements['sources'], 'YouTube', $selectedSource)){
                echo embedFrame($selectedSource['link']).'';
              } else if(isSourceType($interventionEngagements['sources'], 'DailyMotion', $selectedSource)){
                echo embedFrame($selectedSource['link']).'';
              }
              
            ?>
          </div>
          <div class="span4">
            <h2>Sources :</h2>
            <?php 
              echo newSourceModal('modalSource'.$interventionEngagements['id'], $sourceTypes, $interventionEngagements['id'], $interventionEngagements['name'])
                .'<a class="btn" data-toggle="modal" href="#modalSource'.$interventionEngagements['id'].'">Ajouter source</a>'; 
            ?>
            <?php
              if($interventionEngagements['sources'] != null && $interventionEngagements['sources'] != ''){
              echo '
                <table class="table table-striped">
                  <thead>
                  <tr><th>type</th><th>source</th></tr>
                  </thead>
                  <tbody>';
                  foreach($interventionEngagements['sources'] as $key => $source){
                    echo '<tr><td>'.$source['type'].'</td><td><a href="'.$source['link'].'">'.$source['name'].'</a></td></tr>';
                  }
                echo '
                  </tbody>
                </table>';
              }
            ?>
          </div>
        </div>
        <br/>
        <div class="row">
          <div class="span12">
            <h2>Engagements de cette intervention :</h2>
            <?php 
              echo newEngagementModal('modalEngagement'.$interventionEngagements['id'], $engagements, $engagementCategories, $interventionEngagements['id'], $interventionEngagements['name'])
                .'<a class="btn" data-toggle="modal" href="#modalEngagement'.$interventionEngagements['id'].'">Ajouter engagement</a>'; 
            ?>
            
            <?php
              if($interventionEngagements['engagements'] != null && $interventionEngagements['engagements'] != ''){
              echo '<table class="table table-striped">
                <thead>
                <tr><th>#</th><th>Catégorie</th><th>proposition</th><th>Citation exacte</th><th>Référence engagement</th><th>Références</th></tr>
                </thead>
                <tbody>';
                $index = 1;
                foreach($interventionEngagements['engagements'] as $key => $engagement){
                  echo '<tr>
                    <td>'.$index.'</td>
                    <td>'.$engagement['category'].'</td>
                    <td>'.$engagement['content'].'</td>
                    <td>'.$engagement['intervention']['content'].'</td>
                    <td>'.($engagement['intervention']['link'] != '' ? '<a href="'.$engagement['intervention']['link'].'">'.$engagement['intervention']['position'].'</a>' : $engagement['intervention']['position']).'</td>
                    <td>dans '.$engagement['interventionsNb'].' intervention'.($engagement['interventionsNb'] != 1 ? 's' : '').'</td>
                  </tr>';
                  $index++;
                }
                echo '</tbody>
              </table>';
              }
            ?>
          </div>
        </div>
    
    <?php 
      } 
    ?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>