<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/footer.php';
include_once 'server/provider/dataProvider.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Le président à dit"); ?>
</head>
<body>
  <?php echo createHeader("interventions"); ?>
	
  <div class="container">
  
    <div class="row">
      <div class="span12">
        <h1>Interventions</h1> <a href="" class="btn">Nouvelle intervention</a>
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
              $interventions = getInterventions();
              foreach($interventions as $key => $intervention){
                echo '<tr>
                  <td>'.$count.'</td>
                  <td>'.$intervention['type'].'</td>
                  <td><span class="js-tooltip" title="'.$intervention['type'].' du '.$intervention['date'].'">'.$intervention['name'].'</span></td>
                  <td>'.$intervention['date'].' à '.$intervention['heure'].'</td>
                  <td class="fix">
                    <div class="modal hide fade" id="modalSource'.$intervention['id'].'">
                      <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Ajouter une source à "'.$intervention['name'].'"</h3>
                      </div>
                      <div class="modal-body">
                        <p>One fine body…</p>
                      </div>
                      <div class="modal-footer">
                        <a href="#" class="btn">Close</a>
                        <a href="#" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
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
                    </ul>
                  </td>
                  <td class="fix"><a href="" class="btn">'.$intervention['engagementNb'].' engagement'.($intervention['engagementNb'] > 1 ? 's' : '').'</a></td>
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
