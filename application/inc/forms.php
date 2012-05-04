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
              <div class="input-append">
                <input type="text" id="interventionDate" name="interventionDate" placeholder="date de l\'intervention" /><span class="add-on"><i class="icon-calendar"></i></span>
              </div><br/>
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
              <input type="text" id="sourceName" name="sourceName" placeholder="Nom de la source" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="sourceLink">Lien :</label>
            <div class="controls">
              <input type="text" id="sourceLink" name="sourceLink" placeholder="Lien" />
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

function newEngagementForm($engagementCategories){
  $form = '<div class="control-group">
            <label class="control-label" for="engagementCategory">Catégorie :</label>
            <div class="controls">
              <div class="input-append">
                '.enumToSelect($engagementCategories, 'engagementCategory', "Catégorie de l'engagement").'
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="engagementTitle">Titre de l\'engagement :</label>
            <div class="controls">
              <input type="text" id="engagementTitle" name="engagementTitle" placeholder="Titre" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="engagementDesc">Description de l\'engagement :</label>
            <div class="controls">
              <textarea class="input-xlarge" id="engagementDesc" name="engagementDesc" rows="3"></textarea>
            </div>
          </div>';
  return $form;
}

function newEngagementInterventionForm(){
  return '<div class="control-group">
            <label class="control-label" for="originalText">Texte original :</label>
            <div class="controls">
              <textarea class="input-xlarge" id="originalText" name="originalText" rows="3"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="specificLink">Lien spécifique :</label>
            <div class="controls">
              <input type="text" id="specificLink" name="specificLink" placeholder="Lien" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="interventionPos">Emplacement précis :</label>
            <div class="controls">
              <input type="text" id="interventionPos" name="interventionPos" placeholder="Emplacement" /><br/>
              <span class="help-inline">Ex: "minute 23" ou "2ième page 3ième paragraphe"</span>
            </div>
          </div>';
}

function addEngagementForm($engagements, $engagementCategories, $interventionId, $activeTab = 1){
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
              <li'.($activeTab == 1 ? ' class="active"' : '').'><a href="#linkEngagement'.$interventionId.'" data-toggle="tab">Engagement existant</a></li>
              <li'.($activeTab == 2 ? ' class="active"' : '').'><a href="#createEngagement'.$interventionId.'" data-toggle="tab">Nouvel engagement</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane'.($activeTab == 1 ? ' active' : '').'" id="linkEngagement'.$interventionId.'">
                <p>
                  <select name="engagementRef">
                    <option> -- Engagements existant</oprion>';
                  foreach($engagements as $key => $engagement){
                    $form .= '<option value="'.$engagement['id'].'">'.$engagement['title'].'</option>';
                  }
                $form .= '
                  </select>
                </p>
              </div>
              <div class="tab-pane'.($activeTab == 2 ? ' active' : '').'" id="createEngagement'.$interventionId.'">
                <p>
                  <div class="control-group">
                    <label class="control-label" for="engagementTitle">Titre de l\'engagement :</label>
                    <div class="controls">
                      <input type="text" id="engagementTitle" name="engagementTitle" placeholder="Titre" />
                    </div>
                  </div>
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

function addInterventionForm($interventions, $interventionTypes, $sourceTypes, $engagementId, $activeTab = 1){
  $form = '<div class="tabbable">
            <ul class="nav nav-tabs">
              <li'.($activeTab == 1 ? ' class="active"' : '').'><a href="#linkIntervention'.$engagementId.'" data-toggle="tab">Intervention existante</a></li>
              <li'.($activeTab == 2 ? ' class="active"' : '').'><a href="#createIntervention'.$engagementId.'" data-toggle="tab">Nouvelle intervention</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane'.($activeTab == 1 ? ' active' : '').'" id="linkIntervention'.$engagementId.'">
                <p>
                  <select name="interventionRef">
                    <option> -- Intervention existante</oprion>';
                  foreach($interventions as $key => $intervention){
                    $form .= '<option value="'.$intervention['id'].'">'.$intervention['date'].' - '.$intervention['name'].'</option>';
                  }
                $form .= '
                  </select>
                </p>
              </div>
              <div class="tab-pane'.($activeTab == 2 ? ' active' : '').'" id="createIntervention'.$engagementId.'">
                <p>
                  <fieldset>
                    '.newInterventionForm($interventionTypes).'
                  </fieldset>
            
                  <fieldset>
                  <legend>Source :</legend>
                    '.newSourceForm($sourceTypes).'
                  </fieldset>
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