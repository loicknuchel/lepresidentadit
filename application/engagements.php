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
  <?php echo createHeader("engagements"); ?>
	
  <div class="container">
  
    <div class="row">
      <div class="span12">
        <h1>Engagements</h1>
        <a data-toggle="modal" href="#modalAddEngagement" class="btn">Nouvel engagement</a>
        <div class="modal hide fade" id="modalAddEngagement">
          <form class="form-horizontal" method="POST" action="" style="margin: 0px;">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Nouvel engagement</h3>
            </div>
            <div class="modal-body">
              <p>
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="engagement">Texte original :</label>
                    <div class="controls">
                      <textarea class="input-xlarge" id="engagement" name="engagement" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="interventionDate">Date de l'intervention :</label>
                    <div class="controls">
                      <input type="date" id="interventionDate" name="interventionDate" placeholder="date de l'intervention" />
                      <span class="help-inline">Ex: 2012-04-10</span>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="interventionType">Type de l'intervention :</label>
                    <div class="controls">
                      <div class="input-append">
                        <?php echo $interventionSelect; ?>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </p>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <button type="submit" class="btn btn-primary">Enregistrer l'engagement</button>
            </div>
          </form>
        </div>
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
                  <td>'.$engagement['content'].'</td>
                  <td class="fix"><a href="" class="btn">'.$engagement['interventionsNb'].' intervention'.($engagement['interventionsNb'] > 1 ? 's' : '').'</a></td>
                </tr>';
                $count++;
              }
            ?>
          
          
          </tbody>
        </table>
        <pre>
          <?php 
            print_r($engagements);
          ?>
        </pre>
      </div>
    </div>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
