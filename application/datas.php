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
  <?php echo createHeader("donnees"); ?>
	
  <div class="container">
  
    <div class="row">
      <div class="span12">
        <h1>Données</h1>
      </div>
    </div>
    <div class="row">
      <div class="span4">
        
      </div>
      <div class="span8">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>type</th>
              <th>intervention</th>
              <th>date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $interventions = getInterventions();
              foreach($interventions as $key => $intervention){
                echo '<tr>
                  <td>
                    '.$intervention['id'].'
                    <div class="modal hide fade" id="modalSource'.$intervention['id'].'">
                      <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Modal header</h3>
                      </div>
                      <div class="modal-body">
                        <p>One fine body…</p>
                      </div>
                      <div class="modal-footer">
                        <a href="#" class="btn">Close</a>
                        <a href="#" class="btn btn-primary">Save changes</a>
                      </div>
                    </div>
                  </td>
                  <td>'.$intervention['type'].'</td>
                  <td>'.$intervention['name'].'</td>
                  <td>'.$intervention['date'].'</td>
                  <td class="fix">
                    <ul class="nav nav-pills">
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sources <b class="caret"></b></a>
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
                </tr>';
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
