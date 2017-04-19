<?php

/**
 * Implementation of hook_views_plugins().
 */
function views_showup_views_plugins() {
  drupal_add_js(drupal_get_path('module', 'views_showup') .'/js/views.js');
  return array(
    'style' => array(
      'views_showup_effect' => array(
        'title' => t('Views ShowUp'),
        'theme' => 'views_view_showup',
        'help' => t('Display items as jQuery ShowUp Effect.'),
        'handler' => 'views_showup_style_plugin',
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'type' => 'normal',
      ),
    ),
  );
}
