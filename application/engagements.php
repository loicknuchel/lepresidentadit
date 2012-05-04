<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/requestDispatcher.php';
include_once 'server/provider/dataProvider.php';

$res = dispatchRequest($_POST, $_GET, $errorMessage);

$interventionTypes = getInterventionTypes();
$sourceTypes = getSourceTypes();
$engagementCategories = getEngagementCategory();
$interventions = getInterventions();
$engagements = getEngagements();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Le président à dit"); ?>
</head>
<body>
  <?php echo createHeader("engagements"); ?>
	
  <div class="container">
    <?php
      if(($errorMessage != null && $errorMessage != '') || $res = true){
        echo $errorMessage;
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
      }
    ?>
    <div class="row">
      <div class="span12">
        <h1>Engagements</h1>
        <a data-toggle="modal" href="#modalAddEngagement" class="btn">Nouvel engagement</a>
        <?php echo newEngagementModal('modalAddEngagement', $engagementCategories); ?>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="span12">
        <table class="table table-striped myTable">
          <thead>
            <tr>
              <th>#</th>
              <th>catégorie</th>
              <th>titre</th>
              <th>engagement</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $count = 1;
              $engagements = getEngagements();
              foreach($engagements as $key => $engagement){
                echo '<tr>
                  <td>'.$count.'</td>
                  <td>'.$engagement['category'].'</td>
                  <td>'.$engagement['title'].'</td>
                  <td>'.$engagement['content'].'</td>
                  <td style="min-width: 162px;">
                    '.newInterventionEngagementModal('modelIntervention'.$engagement['id'], $interventions, $interventionTypes, $sourceTypes, $engagement['id'], $engagement['title']).'
                    <div class="btn-group">
                      <button class="btn"><a href="engagement-interventions.php?engagement='.$engagement['id'].'">'.($engagement['interventionsNb'] == 0 ? 'aucune intervention' : 'dans '.$engagement['interventionsNb'].' intervention'.($engagement['interventionsNb'] > 1 ? 's' : '')).'</a></button>
                      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                      <ul class="dropdown-menu">'; 
                        foreach($engagement['interventions'] as $interventionKey => $intervention){
                          echo '<li><a href="intervention-engagements.php?intervention='.$intervention['id'].'" title="'.$intervention['position'].'" class="js-tooltip">'.$intervention['name'].' ('.$intervention['type'].')</a></li>';
                        }
                    echo '<li class="divider"></li>
                          <li>
                            <a data-toggle="modal" href="#modelIntervention'.$engagement['id'].'"><i class="icon-plus"></i> Lier à une intervention</a>
                           </li>
                      </ul>
                    </div>
                  </td>
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
