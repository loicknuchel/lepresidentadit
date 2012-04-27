<?php

function newInterventionForm($interventionTypes){
  return '<div class="control-group">
            <label class="control-label" for="intervention">Nom de l\'intervention :</label>
            <div class="controls">
              <input type="text" id="intervention" name="intervention" placeholder="nom de l\'intervention" />
              <span class="help-inline">Ex: Des paroles et des actes</span>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="interventionDate">Date de l\'intervention :</label>
            <div class="controls">
              <input type="date" id="interventionDate" name="interventionDate" placeholder="date de l\'intervention" />
              <span class="help-inline">Ex: 2012-04-10</span>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="interventionType">Type de l\'intervention :</label>
            <div class="controls">
              <div class="input-append">
                '.enumToSelect($interventionTypes, 'interventionType', "Type de l'intervention").'
              </div>
            </div>
          </div>';
}

function newSourceForm($sourceTypes){
  return '<div class="control-group">
            <label class="control-label" for="sourceName">Nom de la source :</label>
            <div class="controls">
              <input class="span3" type="text" id="sourceName" name="sourceName" placeholder="Nom de la source" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sourceLink">Lien :</label>
            <div class="controls">
              <input class="span3" type="text" id="sourceLink" name="sourceLink" placeholder="Lien" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sourceType">Type de source :</label>
            <div class="controls">
              <div class="input-append">
                '.enumToSelect($sourceTypes, 'sourceType', "Type de source").'
              </div>
            </div>
          </div>';
}

function newEngagementInterventionForm(){
  return '<div class="control-group">
            <label class="control-label" for="originalText">Texte original :</label>
            <div class="controls">
              <textarea class="input-xlarge" id="originalText" name="originalText" rows="3"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sourceLink">Lien spécifique :</label>
            <div class="controls">
              <input class="span3" type="text" id="sourceLink" name="sourceLink" placeholder="Lien" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="interventionPos">Emplacement précis :</label>
            <div class="controls">
              <input class="span3" type="text" id="interventionPos" name="interventionPos" placeholder="Emplacement" /><br/>
              <span class="help-inline">Ex: "minute 23" ou "2ième page 3ième paragraphe"</span>
            </div>
          </div>';
}

function addEngagementForm($engagements, $engagementCategories, $interventionId){
  $form = '<div class="control-group">
            <label class="control-label" for="engagementCategory">Catégorie :</label>
            <div class="controls">
              <div class="input-append">
                '.enumToSelect($engagementCategories, 'engagementCategory', "Catégorie de l'engagement").'
              </div>
            </div>
          </div>
          <div class="tabbable">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#linkEngagement'.$interventionId.'" data-toggle="tab">Engagement existant</a></li>
              <li><a href="#createEngagement'.$interventionId.'" data-toggle="tab">Nouvel engagement</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="linkEngagement'.$interventionId.'">
                <p>
                  <select name="engagementRef">
                    <option> -- Engagements existant</oprion>';
                  foreach($engagements as $key => $engagement){
                    $form .= '<option value="'.$engagement['id'].'">'.$engagement['content'].'</option>';
                  }
                $form .= '
                  </select>
                </p>
              </div>
              <div class="tab-pane" id="createEngagement'.$interventionId.'">
                <p>
                  <div class="control-group">
                    <label class="control-label" for="engagementDesc">Description de l\'engagement :</label>
                    <div class="controls">
                      <textarea class="input-xlarge" id="engagementDesc" name="engagementDesc" rows="3"></textarea>
                    </div>
                  </div>
                </p>
              </div>
            </div>
          </div>';
  return $form;
}

// private
function enumToSelect($enums, $name, $default){
  $enumSelect = '<select name="'.$name.'">
  <option> -- '.$default.'</option>';
    foreach($enums as $key => $enum){
      $enumSelect .= '
      <option value="'.$enum['id'].'">'.$enum['name'].'</option>';
    }
  $enumSelect .= '
  </select><span class="add-on"><i class="icon-tag"></i></span>';
  return $enumSelect;
}

?>