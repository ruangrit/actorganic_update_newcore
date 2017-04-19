Drupal.behaviors.views_showup_behaviors = function (context) {
  $('.views-showup').each(function() {
    var id = this.id;
    var settings = Drupal.settings.views_showup[id];
    var $obj = $(this);
    var $items = $('.showup-item', $obj);
    var width = $obj.width() / $items.size();
    var height = $obj.height();

    $items.each(function() {
      var $item = $(this);
      var $title = $('.views-field-'+ settings.views_showup_on_top_field, $item);
      var diff = $item.height() - $title.height();

      $item.css({
        'width': width,
        'top': diff
      }).bind('mouseenter', function(e) {
        $(this).stop().animate({'top': 0}, {queue: false, duration: settings.views_showup_effect_speed});
      }).bind('mouseleave', function(e) {
        $(this).stop().animate({'top': diff}, {queue: false, duration: settings.views_showup_effect_speed});
      });

    });
  });
}
