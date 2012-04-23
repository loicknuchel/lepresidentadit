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
          </tr>
        </thead>
        <tbody>
          <?php
            $interventions = getInterventions();
            foreach($interventions as $key => $intervention){
              echo '<tr>
                <td>'.$intervention['id'].'</td>
                <td>'.$intervention['type'].'</td>
                <td>'.$intervention['name'].'</td>
                <td><a href="#">Ajouter source</a></td>
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
