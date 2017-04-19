Drupal.behaviors.views_showup_style_plugin = function(context) {
  var speed = $('#edit-style-options-views-showup-effect-speed', context);
  var custom = $('#edit-style-options-views-showup-effect-speed-custom', context);
  if (speed.val() != 'custom') {
    custom.parent().hide();
  }

  speed.change(function() {
    if (this.value == 'custom') {
      custom.parent().show();
    }
    else {
      custom.parent().hide();
    }
  });
};
