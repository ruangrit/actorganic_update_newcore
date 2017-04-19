$(document).ready(function () {
  $('#conmsg').click(function () {
    console.log('x');
    var swclass = {'show': 'hide', 'hide': 'show'};
    var nclass = swclass[$(this).attr('class')];
    $.getJSON('/varset/conmsg_class/' + nclass);
    $(this).attr('class', nclass);
  });
});
