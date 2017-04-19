<?php
// $Id$
/**
 * @file
 * Provide a ticker display style for Views. This file is autoloaded by views.
 */

/**
  * Implementation of hook_views_plugin().
  */
function views_ticker_views_plugins() {
  return array(
    'style' => array(
      'views_ticker_scroller' => array(
        'title' => t('Views Ticker'),
        'theme' => 'views_view_ticker',
        'help' => t('Display links to items while scrolling through them.'),
        'handler' => 'views_ticker_style_plugin',
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'type' => 'normal',
      ),
    ),
  );
}
