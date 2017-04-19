Drupal.behaviors.destroyWYSIWYG_FIX = function(context) {
  $('#edit-field-test-field-test-add-more')
    .click(function(){destroyWYSIWYG()})
    .mousedown(function(){destroyWYSIWYG()})
    .keypress(function(){destroyWYSIWYG()});
};

function destroyWYSIWYG(){
  for(var instanceName in CKEDITOR.instances) {
    CKEDITOR.instances[instanceName].destroy();
  }
  return false;
}
