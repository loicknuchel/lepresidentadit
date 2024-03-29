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
$interventions = getInterventions();
$engagements = getEngagements();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Engagements - Le président à dit"); ?>
</head>
<body>
  <?php echo createHeader("engagements", $counts); ?>
	
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
        <h1>Engagements</h1>
      </div>
    </div>
    <div class="row newElt">
      <div class="span12">
        <div class="button">
          <?php echo newEngagementModal('modalAddEngagement', $engagementCategories); ?>
          <a data-toggle="modal" href="#modalAddEngagement" class="btn">Nouvel engagement</a>
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
              <th>titre</th>
              <th>engagement</th>
              <th>interventions</th>
              <th>catégorie</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $count = 1;
              foreach($engagements as $key => $engagement){
                echo '<tr>
                  <th>'.$count.'</th>
                  <td>'.$engagement['title'].'</td>
                  <td>'.$engagement['content'].'</td>
                  <td style="min-width: 162px;">
                    '.newInterventionEngagementModal('modelIntervention'.$engagement['id'], $interventions, $interventionTypes, $sourceTypes, $engagement['id'], $engagement['title']).'
                    <div class="btn-group">
                      <button class="btn"><a href="engagement.php?engagement='.$engagement['id'].'">'.($engagement['interventionsNb'] == 0 ? 'aucune intervention' : 'dans '.$engagement['interventionsNb'].' intervention'.($engagement['interventionsNb'] > 1 ? 's' : '')).'</a></button>
                      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                      <ul class="dropdown-menu">'; 
                        foreach($engagement['interventions'] as $interventionKey => $intervention){
                          echo '<li><a href="intervention.php?intervention='.$intervention['id'].'" title="'.$intervention['position'].'" class="js-tooltip">'.$intervention['name'].' ('.$intervention['type'].')</a></li>';
                        }
                    echo '<li class="divider"></li>
                          <li>
                            <a data-toggle="modal" href="#modelIntervention'.$engagement['id'].'"><i class="icon-plus"></i> Lier à une intervention</a>
                           </li>
                      </ul>
                    </div>
                  </td>
                  <td class="type">'.$engagement['category'].'</td>
                </tr>';
                $count++;
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <?php //echo '<pre>';print_r($engagements);echo '</pre>';?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
