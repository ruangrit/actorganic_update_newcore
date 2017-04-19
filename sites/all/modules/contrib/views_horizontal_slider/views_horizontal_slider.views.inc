<?php
// $Id: views_horizontal_slider.views.inc,v 1.2 2010/07/31 12:56:58 eanima Exp $

/**
 * @file
 * Provide views data and handlers for views_horizontal_slider.module *  
 */

/*
 * Implementation of hook_views_plugins() 
 */
function views_horizontal_slider_views_plugins() {
  return array(
    'style' => array(
      'views_horizontal_slider' => array(
        'title' => t('Horizontal Slider'),
        'help' => t('Displays Content with a Horizontal Slider Effect.'),
        'handler' => 'views_horizontal_slider_plugin_style_slider', // views_horizontal_slider_plugin_style points to views_horizontal_slider_plugin_style.inc
        'parent' => 'list',
        'uses row plugin' => TRUE,
        'uses fields' => TRUE,
        'uses options' => TRUE,
        'type' => 'normal',
        'theme' => 'views_view_horizontal_slider',
      ),
    ),
  );
}

