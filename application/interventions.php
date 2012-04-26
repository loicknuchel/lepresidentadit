<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/modals.php';
include_once 'inc/footer.php';
include_once 'server/provider/dataProvider.php';

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
                  <td class="fix">
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
                            <a data-toggle="modal" href="#modalSource'.$intervention['id'].'">Nouvelle source</a>
                           </li>
                      </ul>
                    </div>
                    <!--
                    <ul class="nav nav-pills">
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sources ('.$intervention['sourcesNb'].') <b class="caret"></b></a>
                        <ul class="dropdown-menu">'; 
                        foreach($intervention['sources'] as $sourceKey => $source){
                          echo '<li><a href="'.$source['link'].'">'.$source['name'].' ('.$source['type'].')</a></li>';
                        }
                    echo '<li class="divider"></li>
                          <li>
                            <a data-toggle="modal" href="#modalSource'.$intervention['id'].'">Nouvelle source</a>
                           </li>
                        </ul>
                      </li>
                    </ul>-->
                  </td>
                  <td class="fix">
                    '.newEngagementModal('modalEngagement'.$intervention['id'], $engagementCategories, $intervention['id'], $intervention['name']).'
                    <div class="btn-group">
                      <button class="btn">'.($intervention['engagementNb'] == 0 ? "Pas d'engagements" : $intervention['engagementNb'].' engagement'.($intervention['engagementNb'] > 1 ? 's' : '')).'</button>
                      <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        '.($intervention['engagementNb'] > 0 ? '<li><a href="#">Voir les engagements</a></li>' : '').'
                        <li class="divider"></li>
                        <li><a data-toggle="modal" href="#modalEngagement'.$intervention['id'].'">Nouvel engagement</a></li>
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
    
    
    
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
