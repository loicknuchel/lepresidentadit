<?php
function createHeader($page, $counts){
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
        <div class="nav-collapse" id="top-menu">
          <ul class="nav">
            <li'.($page == 'interventions' ? ' class="active"' : '').'><a href="interventions.php">Interventions</a><span class="label">'.$counts['interventions'].'</span></li>
            <li'.($page == 'engagements' ? ' class="active"' : '').'><a href="engagements.php">Engagements</a><span class="label">'.$counts['engagements'].'</span></li>
            <li'.($page == 'citations' ? ' class="active"' : '').'><a href="citations.php">Citations</a><span class="label">'.$counts['citations'].'</span></li>
            <li'.($page == 'datas' ? ' class="active"' : '').'><a href="datas.php">Données brutes</a></li>
            <li'.($page == 'about' ? ' class="active"' : '').'><a href="about.php">A propos</a></li>
            <li'.($page == 'contact' ? ' class="active"' : '').'><a href="contact.php">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div style="height: 60px;"></div>
  ';
}
?>