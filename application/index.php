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
  <?php echo createHeader("home", getCounts()); ?>
	
    
    
    <div class="block-sample">
      <h1>Titre 1</h1>
      <h2>Titre 2</h2>
      <h3>Titre 3</h3>
      <h4>Titre 4</h4>
      <h5>Titre 5</h5>
      <h6>Titre 6</h6>
    </div>
    
    <div class="block-sample">
      <ul>
        <li>item 1</li>
        <li>item 2</li>
        <li>
          <ul>
            <li>item 3.1</li>
            <li>item 3.2</li>
          </ul>
        </li>
        <li>item 4</li>
      </ul>
    </div>
    <div class="block-sample">
      <ul class="unstyled">
        <li>item 1</li>
        <li>item 2</li>
        <li>
          <ul>
            <li>item 3.1</li>
            <li>item 3.2</li>
          </ul>
        </li>
        <li>item 4</li>
      </ul>
    </div>
    <div class="block-sample">
      <ol>
        <li>item 1</li>
        <li>item 2</li>
        <li>
          <ol>
            <li>item 3.1</li>
            <li>item 3.2</li>
          </ol>
        </li>
        <li>item 4</li>
      </ol>
    </div>
    <div class="block-sample">
      <ol class="unstyled">
        <li>item 1</li>
        <li>item 2</li>
        <li>
          <ol>
            <li>item 3.1</li>
            <li>item 3.2</li>
          </ol>
        </li>
        <li>item 4</li>
      </ol>
    </div>
    
    
    <div class="block-sample">
      this is some <code>code exemple</code>.
      <p>
        Here, this is a paragraph.
      </p>
      <pre>
        And here, a pre block !
      </pre>
      <pre class="prettyprint linenums" style="margin-bottom: 9px;"><ol class="linenums"><li class="L0"><span class="tag">&lt;pre&gt;</span></li><li class="L1"><span class="pln">  &amp;lt;p&amp;gt;Sample text here...&amp;lt;/p&amp;gt;</span></li><li class="L2"><span class="tag">&lt;/pre&gt;</span></li></ol></pre>
    </div>
    
    <div class="block-sample">
      <table class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th>col 1</th>
            <th>col 2</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>row 1</td>
            <td>row 2</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="block-sample">
      <form>
        <label><i class="icon-search"></i> Nom :</label>
        <input type="text" class="span3" placeholder="Type something…">
        <span class="help-inline">Associated help text!</span>
        <label class="checkbox">
          <input type="checkbox"> Check me out
        </label>
        <button type="submit" class="btn">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div class="progress">
        <div class="bar" style="width: 60%;"></div>
      </div>
    </div>
    
    <div class="block-sample">
      <div class="btn-group">
        <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> User</a>
        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
          <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
          <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="i"></i> Make admin</a></li>
        </ul>
      </div>
      <br/>
      <div class="span3">
        <div class="well" style="padding: 8px 0;">
          <ul class="nav nav-list">
            <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
            <li><a href="#"><i class="icon-book"></i> Library</a></li>
            <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
            <li><a href="#"><i class="i"></i> Misc</a></li>
          </ul>
        </div> <!-- /well -->
      </div>
    </div>
    
    
  <?php echo createFooter(); ?>
</body>
</html>
