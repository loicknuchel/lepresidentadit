<?php
include_once 'inc/forms.php';

function newInterventionModal($id, $interventionTypes, $sourceTypes){
  return '<div class="modal hide fade" id="'.$id.'">
          <form class="form-horizontal" method="POST" action="">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Nouvelle intervention</h3>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
              <button type="submit" class="btn btn-primary">Enregistrer l\'intervention</button>
            </div>
          </form>
        </div>';
}

function newSourceModal($id, $sourceTypes, $interventionId, $interventionName){
  return '<div class="modal hide fade" id="'.$id.'">
            <form class="form-horizontal" method="POST" action="">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Ajouter une source à "'.$interventionName.'"</h3>
              </div>
              <div class="modal-body">
                <p>
                  <fieldset>
                    <input type="hidden" name="interventionId" value="'.$interventionId.'" />
                    '.newSourceForm($sourceTypes).'
                  </fieldset>
                </p>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>';
}

function newEngagementInterventionModal($id, $engagements, $engagementCategories, $interventionId, $interventionName){
  return '<div class="modal hide fade" id="'.$id.'">
            <form class="form-horizontal" method="POST" action="">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Ajouter un engagement à "'.$interventionName.'"</h3>
              </div>
              <div class="modal-body">
                <p>
                  <fieldset>
                    <input type="hidden" name="interventionId" value="'.$interventionId.'" />
                    '.newEngagementInterventionForm().'
                  </fieldset>
                  
                  <fieldset>
                    '.addEngagementForm($engagements, $engagementCategories, $interventionId).'
                  </fieldset>
                </p>
              </div>
              <div class="modal-footer">
                <a href="" class="btn" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>';
}

function newEngagementModal($id, $engagementCategories){
  return '<div class="modal hide fade" id="'.$id.'">
            <form class="form-horizontal" method="POST" action="">
              <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Ajouter un engagement</h3>
              </div>
              <div class="modal-body">
                <p>
                  <fieldset>
                    '.newEngagementForm($engagementCategories).'
                  </fieldset>
                </p>
              </div>
              <div class="modal-footer">
                <a href="" class="btn" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>';
}

?>