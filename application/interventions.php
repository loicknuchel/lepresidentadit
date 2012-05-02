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
	<?php echo createHead("Le président à dit..."); ?>
</head>
<body>
  <?php echo createHeader("interventions"); ?>
	
  <div class="container">
    
    <div class="row">
      <div class="span12">
        <h1>Interventions</h1>
        <a data-toggle="modal" href="#modalAddIntervention" class="btn">Nouvelle intervention</a>
        <?php echo newInterventionModal('modalAddIntervention', $interventionTypes, $sourceTypes); ?>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="span12">
        <table class="table table-striped myTable">
          <thead>
            <tr>
              <th>#</th>
              <th>type</th>
              <th>intervention</th>
              <th>date</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $count = 1;
              foreach($interventions as $key => $intervention){
                echo '<tr>
                  <td>'.$count.'</td>
                  <td>'.$intervention['type'].'</td>
                  <td><span class="js-tooltip" title="'.$intervention['type'].' du '.$intervention['date'].'">'.$intervention['name'].'</span></td>
                  <td>'.$intervention['date'].' à '.$intervention['heure'].'</td>
                  <td>
                    '.newSourceModal('modalSource'.$intervention['id'], $sourceTypes, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn" data-toggle="dropdown">'.($intervention['sourcesNb'] == 0 ? "Pas de sources" : $intervention['sourcesNb'].' source'.($intervention['sourcesNb'] > 1 ? 's' : '')).'</button>
                      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                      <ul class="dropdown-menu">'; 
                        foreach($intervention['sources'] as $sourceKey => $source){
                          echo '<li><a href="'.$source['link'].'">'.$source['name'].' ('.$source['type'].')</a></li>';
                        }
                    echo '<li class="divider"></li>
                          <li>
                            <a data-toggle="modal" href="#modalSource'.$intervention['id'].'"><i class="icon-plus"></i> Nouvelle source</a>
                           </li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    '.newEngagementInterventionModal('modalEngagement'.$intervention['id'], $engagements, $engagementCategories, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn"><a href="intervention-engagements.php?intervention='.$intervention['id'].'">'.($intervention['engagementsNb'] == 0 ? "Pas d'engagements" : $intervention['engagementsNb'].' engagement'.($intervention['engagementsNb'] > 1 ? 's' : '')).'</a></button>
                      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        '.($intervention['engagementsNb'] > 0 ? '<li><a href="intervention-engagements.php?intervention='.$intervention['id'].'">Voir les engagements</a></li>' : '').'
                        <li class="divider"></li>
                        <li><a data-toggle="modal" href="#modalEngagement'.$intervention['id'].'"><i class="icon-plus"></i> Nouvel engagement</a></li>
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
    
    <?php //echo '<pre>';print_r($interventions);echo '</pre>';?>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
