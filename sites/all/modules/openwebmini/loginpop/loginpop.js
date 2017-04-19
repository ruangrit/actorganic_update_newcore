$(document).ready(function () {
  $('a.pop-login-link').click(function (e) {
    e.preventDefault();
    $('.loginpop-login-form').toggleClass('activepop');
    $('.pop-toggle').toggleClass('popdown');

    $('input', '.loginpop-login-form')[0].focus();
  });

  $('.loginpop-login-form').mouseup(function (e) {
    e.stopPropagation();
  });

  $(document).mouseup(function (e) {
    if ($(e.target).parent('a.pop-login-link, .pop-toggle').length == 0) {
      $('.loginpop-login-form').removeClass('activepop');
      $('.pop-toggle').removeClass('popdown');
    }
  });
});
