<?php

define("BASETHEME_CUFON_NUM_ELEMENTS", 3, TRUE);

/**
 * Theme settings callback.
 */
function basetheme_settings($saved_settings) {
  $form = array();

  // Cufon settings form.
  _basetheme_cufon_settings($form, $saved_settings);

  return $form;
}

/**
 * Cufon settings.
 */
function _basetheme_cufon_settings(&$form, $settings) {
  if (module_exists('cufon')) {
    drupal_set_message(t('Theme settings for Cufon cannot work with cufon module. Please <a href="!link">disable cufon module</a> to use theme settings.', array('!link' => url('admin/build/modules'))), 'warning');
    return;
  }
  $theme_path = drupal_get_path('theme', 'basetheme');
  drupal_add_css($theme_path .'/css/cufon-admin.css', 'theme');
  $form['cufon_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Cufon'),
    '#tree' => TRUE,
    '#description' => t('You may add as many selector / font combinations as you would like.  To add additional input fields, save to add @count more.', array('@count' => BASETHEME_CUFON_NUM_ELEMENTS)),
  );
  $elements = BASETHEME_CUFON_NUM_ELEMENTS;;
  if (isset($settings['cufon_settings'])) {
    foreach ($settings['cufon_settings'] as $setting) {
      if ($setting['selector'] && $setting['options']['fontFamily']) {
        $elements++;
      }
    }
  }
  for ($i = 0; $i < $elements; $i++) {
    $form['cufon_settings'][$i] = array(
      'selector' => array(
        '#type' => 'textarea',
        '#title' => t('Selector'),
        '#cols' => 40,
        '#rows' => 3,
        '#prefix' => '<div class="cufon-selector">',
        '#suffix' => '</div>',
        '#default_value' => $settings['cufon_settings'][$i]['selector'],
      ),
      'options' => array(
        '#tree' => TRUE,
        'fontFamily' => array(
          '#type' => 'select',
          '#title' => t('Font family'),
          '#options' => _basetheme_cufon_get_option(),
          '#prefix' => '<div class="cufon-font-family">',
          '#suffix' => '</div>',
          '#default_value' => $settings['cufon_settings'][$i]['options']['fontFamily'],
        ),
        'hover' => array(
          '#type' => 'checkbox',
          '#title' => t('Enable hover state support'),
          '#default_value' => $settings['cufon_settings'][$i]['options']['hover'],
          '#description' => t('Adds support for <code>:hover</code> states.  For performance reasons, this is disabled by default.'),
          '#prefix' => '<div class="cufon-hover">',
          '#suffix' => '</div>',
        ),
        '#prefix' => '<div class="cufon-options">',
        '#suffix' => '</div>',
      ),
      '#prefix' => '<div class="cufon-settings-row clear-block">',
      '#suffix' => '</div>',
    );
  }
  return $form;
}

/**
 * Get fonts option for select list.
 */
function _basetheme_cufon_get_option() {
  $fonts = array(t('- Please select -'));
  $fonts = array_merge($fonts, _basetheme_cufon_get_fonts());
  return $fonts;
}

/**
 * Scan cufon fonts in <theme path>/cufon-fonts
 */
function _basetheme_cufon_get_fonts($theme_name = NULL) {
  if ($theme_name == NULL) $theme_name = arg(4);
  $fonts_path = drupal_get_path('theme', $theme_name) .'/cufon-fonts';
  $files = file_scan_directory($fonts_path, '.font.js');
  $fonts = array();
  foreach ($files as $filename => $file) {
    $fonts[$filename] = _basetheme_get_font_family($file->basename);
  }
  return $fonts;
}

/**
 * Parse cufon js filename to font family.
 */
function _basetheme_get_font_family($filename) {
  $family = str_replace('.font.js', '', $filename);

  // Split on hyphen
  if (($hyphen_pos = strpos($family, '-')) && ($hyphen_pos !== FALSE)) {
    $family = substr($family, 0, $hyphen_pos);
  }

  // Split on last underscore and see if its numeric
  $suffix_pos = strrpos($family, '_');
  $suffix = substr($family, $suffix_pos + 1);
  if (is_numeric($suffix)) {
    $family = substr($family, 0, $suffix_pos);
  }

  // Remove remaining hyphens and add to our array
  $family = str_replace('_', ' ', $family);

  return $family;
}
