<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/utils/embed.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

$counts = getCounts();
$sourceTypes = getSourceTypes();
$engagementCategories = getEngagementCategory();
$citationCategories = getCitationCategory();
$engagements = getEngagements();
$interventionEngagements = getInterventionEngagements($_GET['intervention']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Intervention ".$_GET['intervention']." - Le président à dit..."); ?>
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
    <?php 
      if($interventionEngagements != null && $interventionEngagements != ''){ 
    ?>
    
        <div class="row title">
          <div class="span12">
            <h1><?php echo $interventionEngagements['type'].' : '.$interventionEngagements['name']; ?></h1>
          </div>
        </div>
        <div class="row datas">
          <div class="span8">
            <?php
              echo '<div class="sources">';
              if($interventionEngagements['sources'] != null && $interventionEngagements['sources'] != '') {
                foreach($interventionEngagements['sources'] as $key => $source){
                  if($source['ordre'] == 1){
                    echo '<div class="source'.$source['id'].'">'.embedFrame($source['link']).'</div>';
                  } else {
                    echo '<div class="source'.$source['id'].'" style="display: none;">'.embedFrame($source['link']).'</div>';
                  }
                }
              }
              echo '</div>';
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
                  <tr>
                    <th>source</th>
                    <th>type</th>
                  </tr>
                  </thead>
                  <tbody>';
                  foreach($interventionEngagements['sources'] as $key => $source){
                    echo '<tr data-source="source'.$source['id'].'">
                      <td><a href="'.$source['link'].'">'.$source['name'].'</a></td>
                      <td class="type">'.$source['type'].'</td>
                    </tr>';
                  }
                echo '
                  </tbody>
                </table>';
              }
            ?>
          </div>
        </div>
        <div class="row datas">
          <div class="span12">
            <h2>Engagements de cette intervention :</h2>
            <?php 
              echo newEngagementInterventionModal('modalEngagement'.$interventionEngagements['id'], $engagements, $engagementCategories, $interventionEngagements['id'], $interventionEngagements['name'])
                .'<a class="btn" data-toggle="modal" href="#modalEngagement'.$interventionEngagements['id'].'">Ajouter engagement</a>'; 
            ?>
            
            <?php
              if($interventionEngagements['engagements'] != null && $interventionEngagements['engagements'] != ''){
                echo '<table class="table table-striped">
                  <thead>
                  <tr>
                    <th></th>
                    <th>titre</th>
                    <th>proposition</th>
                    <th>citation exacte</th>
                    <th>catégorie</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>';
                  $count = 1;
                  // interventionsNb est ici le nombre de fois que revient l'engagement dans l'intervention choisie (where intervention=...)
                  foreach($interventionEngagements['engagements'] as $key => $engagement){
                    foreach($engagement['interventions'] as $iKey => $intervention){
                      echo '<tr>
                        <th>'.$count.'</th>
                        <td>'.$engagement['title'].'</td>
                        <td>'.$engagement['content'].'</td>
                        <td class="js-tooltip" title="'.$intervention['position'].'">'.($intervention['link'] != '' ? '<a href="'.$intervention['link'].'">'.$intervention['content'].'</a>' : $intervention['content']).'</td>
                        <td class="type">'.$engagement['category'].'</td>
                        <td><a class="btn js-tooltip" href="engagement.php?engagement='.$engagement['id'].'" title="'.$engagement['interventionsNb'].' fois dans cette intervention">=></a></td>
                      </tr>';
                      $count++;
                    }
                  }
                  echo '</tbody>
                </table>';
              }
            ?>
          </div>
        </div>
        <div class="row datas">
          <div class="span12">
            <h2>Citations de cette intervention :</h2>
            <?php 
              echo addCitationModal('modalAddCitation'.$interventionEngagements['id'], $citationCategories, $interventionEngagements['id'], $interventionEngagements['name'])
                .'<a class="btn" data-toggle="modal" href="#modalAddCitation'.$interventionEngagements['id'].'">Ajouter citation</a>';
            ?>
            
            <?php
              if($interventionEngagements['citations'] != null && $interventionEngagements['citations'] != ''){
                echo '<table class="table table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>citation</th>
                      <th>référence exacte</th>
                      <th>catégorie</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $count = 1;
                  foreach($interventionEngagements['citations'] as $key => $citation){
                    echo '<tr>
                      <th>'.$count.'</th>
                      <td>'.$citation['citation'].'</td>
                      <td>'.($citation['citationLink'] == null || $citation['citationLink'] == '' ? $citation['citationPos'] : '<a href="'.$citation['citationLink'].'">'.$citation['citationPos'].'</a>').'</td>
                      <td class="type">'.$citation['category'].'</td>
                    </tr>';
                    $count++;
                  }
                  echo '</tbody>
                </table>';
              }
            ?>
          </div>
        </div>
        
        <?php //echo '<pre>';print_r($interventionEngagements);echo '</pre>';?>
    <?php 
      } 
    ?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
