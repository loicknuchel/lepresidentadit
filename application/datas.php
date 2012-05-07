<?php
include_once 'inc/head.php';
include_once 'inc/header.php';
include_once 'inc/footer.php';
include_once 'server/provider/dataProvider.php';
$counts = getCounts();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo createHead("Datas - Le président à dit"); ?>
</head>
<body>
  <?php echo createHeader("datas", $counts); ?>
	
  <div class="container">
  
    <div class="row">
      <div class="span12">
        <h1>Datas</h1>
      </div>
    </div>
    <div class="row">
      <div class="span4">
        
      </div>
      <div class="span8">
        
      </div>
    </div>
  </div>
    
  <?php echo createFooter(); ?>
</body>
</html>
