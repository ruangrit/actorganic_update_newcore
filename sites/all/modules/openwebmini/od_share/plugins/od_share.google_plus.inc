<?php

/**
 * Return info.
 */
function od_share_google_plus_info() {
  return array(
    'name' => t('Google plus'),
    'display callback' => 'od_share_google_plus_display',
    'options callback' => 'od_share_google_plus_options',
  );
}

/**
 * Return HTML.
 */
function od_share_google_plus_display($vars) {
  foreach ($vars as $key => $value) {
    $$key = $value;
  }
  if ($option == 'bubblie_standard_24') {
  
  }
  elseif ($option == 'none_bubblie_standard_24') {
   $style = 'data-annotation="none"';
  }
  elseif ($option == 'bubblie_small_15') {

    $size = 'data-size="small"';
  }
  elseif ($option == 'none_bubblie_small_15') {
    $size = 'data-size="small"';
    $style = 'data-annotation="none"';
  }
  elseif ($option == 'bubblie_medium_20') {

    $size = 'data-size="medium"';
  }
  elseif ($option == 'none_bubblie_medium_20') {
    $size = 'data-size="medium"';
    $style = 'data-annotation="none"';
  }
  elseif ($option == 'bubblie_tall_60') {

    $size = 'data-size="tall"';
  }
  elseif ($option == 'none_bubblie_tall_60') {
    $size = 'data-size="tall"';
    $style = 'data-annotation="none"';
  }


  $use_path_alias = variable_get('od_share_use_path_alias', FALSE);
  if ($use_path_alias) {
    $path_alias = drupal_get_path_alias($_GET['q']);
    $url = url($path_alias, array('absolute' => TRUE));
  }

  $output = '<div class="g-plusone" '. $size . $style .'></div>';
  $output .= '<script type="text/javascript">
  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';
  return $output;
}

/**
 * Return options form.
 */
function od_share_google_plus_options() {
  return array(
    'bubblie_small_15' => 'Count small (15px)',
    'none_bubblie_small_15' => 'none Count small (15px)',
    'bubblie_medium_20' => 'Count medium (20px)',
    'none_bubblie_medium_20' => 'none Count medium (20px)',
    'bubblie_standard_24' => 'Count Standard (24px)',
    'none_bubblie_standard_24' => 'none Count Standard (24px)',
    'bubblie_tall_60' => 'Count tall (60px)',
    'none_bubblie_tall_60' => 'none Count tall (60px)',
  );
}
