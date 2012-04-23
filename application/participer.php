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
  <?php echo createHeader("participer"); ?>
	
  <div class="container">
  
    <div class="row">
      <div class="span12">
        <h1>Participer au site</h1>
      </div>
    </div>
    <div class="row">
      <div class="span4">
        a
      </div>
      <div class="span8">
        <form class="well form-horizontal" method="POST" action="">
          <fieldset>
          <legend>Nouvelle intervention</legend>
            <div class="control-group">
              <label class="control-label" for="intervention">Nom de l'intervention :</label>
              <div class="controls">
                <input type="text" id="intervention" name="intervention" placeholder="nom de l'intervention" />
                <span class="help-inline">Ex: Des paroles et des actes du xx/04/2012</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="interventionType">Type de l'intervention :</label>
              <div class="controls">
                <div class="input-append">
                  <select name="interventionType">
                    <option> -- Type de l'intervention</option>
                    <?php
                      $interventionTypes = getInterventionTypes();
                      foreach($interventionTypes as $key => $interventionType){
                        echo '<option value="'.$interventionType['id'].'">'.$interventionType['name'].'</option>';
                      }
                    ?>
                  </select><span class="add-on"><i class="icon-tag"></i></span>
                </div>
              </div>
            </div>
          </fieldset>
          
          <fieldset>
          <legend>Source :</legend>
            <div class="control-group">
              <label class="control-label" for="sourceLink">Lien de l'intervention :</label>
              <div class="controls">
                <input class="span3" type="text" id="sourceLink" name="sourceLink" placeholder="Lien de l'intervention" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="sourceType">Type de source :</label>
              <div class="controls">
                <div class="input-append">
                  <select name="sourceType">
                    <option> -- Type de source</option>
                    <?php
                      $sourceTypes = getSourceTypes();
                      foreach($sourceTypes as $key => $sourceType){
                        echo '<option value="'.$sourceType['id'].'">'.$sourceType['name'].'</option>';
                      }
                    ?>
                  </select><span class="add-on"><i class="icon-tag"></i></span>
                </div>
              </div>
            </div>
            
          </fieldset>
          
          
          <button type="submit" class="btn">Enregistrer l'intervention</button>
        </form>
      </div>
    </div>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
