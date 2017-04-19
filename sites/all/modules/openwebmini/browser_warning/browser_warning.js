$(document).ready(function() {
  $.getJSON(Drupal.settings.basePath + 'browser_warning/getmessages?r=' + Math.random(), function(messages) {
    if (messages) {
      var output = '<div id="browser-warning" style="display:none">';
      output += '<div class="messages">';
      for ( i in messages ) {
        output += '<div class="message">' + messages[i] + '</div>';
      }
      output += '<a class="close-button" href="#">Close</a>';
      output += '</div>';
      output += '</div>';
      $('body').prepend(output);
      $('.close-button').click(function() {
        $('div#browser-warning').hide(1000);
      });
      $('div#browser-warning').show(1000);
    }
  });
});
