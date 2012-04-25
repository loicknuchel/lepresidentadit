<?php
function createHeader($page){
  return '
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="./">Le président à dit...</a>
        <div class="nav-collapse">
          <ul class="nav">
            <li'.($page == 'home' ? ' class="active"' : '').'><a href="./">Home</a></li>
            <li'.($page == 'interventions' ? ' class="active"' : '').'><a href="interventions.php">Interventions</a></li>
            <li'.($page == 'engagements' ? ' class="active"' : '').'><a href="engagements.php">Engagements</a></li>
            <li'.($page == 'participer' ? ' class="active"' : '').'><a href="participer.php">Participer</a></li>
            <li'.($page == 'about' ? ' class="active"' : '').'><a href="#">About</a></li>
            <li'.($page == 'contact' ? ' class="active"' : '').'><a href="#">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div style="height: 60px;"></div>
  ';
}
?>