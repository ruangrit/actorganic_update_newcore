function ajax_init() {
  try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {}
  try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {}
  try { return new XMLHttpRequest(); } catch(e) {}
  alert("XMLHttpRequest not supported");
  return null;
}

function browser_detect() {
  var browser_name = navigator.appName;
  var browser_version = parseFloat(navigator.appVersion);

  //if (browser_name == 'Microsoft Internet Explorer' && browser_version < 6.0) {
  //  alert('you use ie < 6');
    // ajax object
    var request = ajax_init();
    request.open('GET', Drupal.settings.basePath + 'browser_warning/getmessages?r=' + Math.random(), true);
    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        if (request.status == 200) {
          var messages = eval('(' + request.responseText + ')');

		  var firstDiv = document.getElementsByTagName('body')[0];
		  var output = '<div id="browser-warning" style="display:none">';
	      output += '<div class="messages">';
	      for ( i in messages ) {
	        output += '<div class="message">' + messages[i] + '</div>';
	      }
	      output += '<a class="close-button" href="javascript:toggle_warning()">Close</a>';
	      output += '</div>';
	      output += '</div>';
		  firstDiv.innerHTML = output + firstDiv.innerHTML;
		  toggle_warning();
        }
      }
    }
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(null);
  //}
}

function toggle_warning() {
  var div = document.getElementById('browser-warning');
  div.style.display = div.style.display == 'none' ? '' : 'none';
}

window.onload = browser_detect;
