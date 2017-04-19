<?php

// Dont know it works or not.
date_default_timezone_set('UTC');

/**
 * Override theme function 'theme_node_submitted'.
 */
function basetheme_node_submitted($node) {
  return t('Submitted by !username on @datetime',
    array(
    '!username' => theme('username', $node),
    '@datetime' => format_date($node->created, 'custom', 'j F Y H:i'),
  ));
}

/**
 * Override theme function 'theme_comment_submitted'.
 */
function basetheme_comment_submitted($comment) {
  return t('Submitted by !username on @datetime',
    array(
    '!username' => theme('username', $comment),
    '@datetime' => format_date($comment->timestamp, 'custom', 'j F Y H:i'),
  ));
}

/**
 * Preprocess page function.
 */
function basetheme_preprocess_page(&$vars) {
  global $theme;
  $base_theme_path = drupal_get_path('theme', 'basetheme');

  // Need function '_basetheme_cufon_get_fonts'.
  require_once $base_theme_path .'/theme-settings.php';

  // Add JavaScripts.
  drupal_add_js($base_theme_path . '/js/cufon-thai.packed.js', 'theme');
  drupal_add_js($base_theme_path .'/js/cufon-drupal.js', 'theme', 'footer');

  $settings = theme_get_setting('cufon_settings');
  if ($settings) {
    $fonts = _basetheme_cufon_get_fonts($theme);
    $selectors = array();
    foreach ($settings as $setting) {
      if ($setting['selector'] && $setting['options']['fontFamily']) {
        $font_path = $setting['options']['fontFamily'];
        $setting['options']['fontFamily'] = $fonts[$font_path];
        $selectors[] = $setting;
        drupal_add_js($font_path, 'theme');
      }
    }

    if ($selectors) {
      drupal_add_js(array('cufonSelectors' => $selectors), 'setting');
    }

    // Regenerate html scripts.
    $vars['scripts'] = drupal_get_js();
    $vars['closure'] = theme('closure'); 
  }

  // Add classes.
  $vars['wrapper_classes'] = $vars['body_classes'];
  $vars['body_classes'] = drupal_is_front_page() ? 'front' : 'not-front';
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function basetheme_preprocess_node(&$vars, $hook) {
  global $user;

  // Set the node id.
  $vars['node_id'] = 'node-'. $vars['node']->nid;

  // Special classes for nodes, emulate Drupal 7.
  $classes = array();
  $classes[] = 'node';
  if ($vars['promote']) {
    $classes[] = 'node-promoted';
  }
  if ($vars['sticky']) {
    $classes[] = 'node-sticky';
  }
  if (!$vars['status']) {
    $classes[] = 'node-unpublished';
  }
  if ($vars['teaser']) {
    // Node is displayed as teaser.
    $classes[] = 'node-teaser';
  }
  else {
    $classes[] = 'node-full';
  }
  if (isset($vars['preview'])) {
    $classes[] = 'node-preview';
  }
  // Class for node type: "node-type-page", "node-type-story", "node-type-my-custom-type", etc.
  $classes[] = 'node-'. $vars['node']->type;
  $vars['classes'] = implode(' ', $classes); // Concatenate with spaces.

  // Modify classes for $terms to help out themers.
  $vars['terms'] = theme('links', $vars['taxonomy'], array('class' => 'links tags'));
  $vars['links'] = theme('links', $vars['node']->links, array('class' => 'links'));

  // Set messages if node is unpublished.
  if (!$vars['node']->status) {
    if ($vars['page']) {
      drupal_set_message(t('%title is currently unpublished', array('%title' => $vars['node']->title)), 'warning    ');
    }
    else {
      $vars['unpublished'] = '<span class="unpublished">'. t('Unpublished') .'</span>';
    }
  }
}


/**
 * Override or insert variables into block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called.
 */
function basetheme_preprocess_block(&$vars, $hook) {
  $block = $vars['block'];
  
  // Set the block id.
  $vars['block_id'] = 'block-'. $block->module .'-'. $block->delta;

  // Special classes for blocks, emulate Drupal 7.
  // Set up variables for navigation-like blocks.
  $n1 = array('user-1', 'statistics-0');
  $n2 = array('menu', 'book', 'forum', 'blog', 'aggregator', 'comment');
  $h1 = $block->module .'-'. $block->delta;
  $h2 = $block->module;

  // Special classes for blocks
  $classes = array();
  $classes[] = 'block';
  $classes[] = 'block-'. $block->module;
  // Add nav class to navigation-like blocks.
  if (in_array($h1, $n1)) {
    $classes[] = 'nav';
  }
  if (in_array($h2, $n2)) {
    $classes[] = 'nav';
  }

  // Optionally use additional block classes
  //$classes[] = $vars['block_zebra'];        // odd, even zebra class
  //$classes[] = 'block-'. $block->region;    // block-[region] class
  //$classes[] = 'block-count-'. $vars['id']; // block-count-[count] class
  $vars['classes'] = implode(' ', $classes);
  
  /**
   * Add block edit links. Credit to the Zen theme for this implimentation. The only
   * real difference is that the Zen theme wraps each link in span, whereas Genesis 
   * outputs the links as an item-list. Also I have omitted the Views links as these 
   * seem redundant because Views has its own set of hover links.
   */
  if (user_access('administer blocks')) {
    // Display a 'Edit Block' link for blocks.
    if ($block->module == 'block') {
      $edit_links[] = l(t('Edit Block'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta, 
        array(
          'attributes' => array(
            'class' => 'block-edit',
          ),
          'query' => drupal_get_destination(),
          'html' => TRUE,
        )
      );
    }
    // Display 'Configure' for other blocks.
    else {
      $edit_links[] = l(t('Configure'), 'admin/build/block/configure/'. $block->module .'/'. $block->delta,
        array(
          'attributes' => array(
            'class' => 'block-edit',
          ),
          'query' => drupal_get_destination(),
          'html' => TRUE,
        )
      );
    }
    // Display 'Edit Menu' for menu blocks.
    if (($block->module == 'menu' || ($block->module == 'user' && $block->delta == 1)) && user_access('administer menu')) {
      $menu_name = ($block->module == 'user') ? 'navigation' : $block->delta;
      $edit_links[] = l( t('Edit Menu'), 'admin/build/menu-customize/'. $menu_name, 
        array(
          'attributes' => array(
            'class' => 'block-edit',
          ),
          'query' => drupal_get_destination(),
          'html' => TRUE,
        )
      );
    }
    // Theme links as an item list.
    $vars['edit_links'] = '<div class="block-edit">'. theme('item_list', $edit_links) .'</div>';
  }
}

/**
 * Override theme_menu_item_link function for active trail menu.
 */
function basetheme_menu_item_link($link) {
  if (empty($link['localized_options'])) {
    $link['localized_options'] = array();
  }

  $current_path = drupal_get_path_alias($_GET['q']);
  if (strpos($current_path, $link['href'] .'/') !== FALSE) {
    if (isset($link['localized_options']['attributes']['class'])) {
      $link['localized_options']['attributes']['class'] .= ' active';
    }
    else {
      $link['localized_options']['attributes']['class'] = 'active';
    }
  }

  return l($link['title'], $link['href'], $link['localized_options']);
}

/**
 * Display a Scribd.com file via iPaper.
 */
function basetheme_scribdfield_formatter_ipaper($element) {
  if (is_array($element['#item']['data'])) {
    $height = 760;
    $data = $element['#item']['data'];
    $output  = '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" id="doc_' . $data['scribd_doc_id'] . '" name="doc_' . $data['scribd_doc_id'] . '" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" align="middle" height="500" width="100%" rel="media:document" resource="http://d.scribd.com/ScribdViewer.swf?document_id=' . $data['scribd_doc_id'] . '&amp;access_key=' . $data['scribd_access_key'] . '&amp;page=1&amp;version=1&amp;viewMode=" xmlns:media="http://search.yahoo.com/searchmonkey/media/" xmlns:dc="http://purl.org/dc/terms/">';
    $output .=  '<param name="movie" value="http://d.scribd.com/ScribdViewer.swf?document_id=' . $data['scribd_doc_id'] . '&amp;access_key=' . $data['scribd_access_key'] . '&amp;page=1&amp;version=1&amp;viewMode=">';
    $output .=  '<param name="quality" value="high"><param name="play" value="true"><param name="loop" value="true"><param name="scale" value="showall"><param name="wmode" value="opaque"><param name="devicefont" value="false">';
    $output .=  '<param name="bgcolor" value="#ffffff"><param name="menu" value="true"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><param name="salign" value="">';
    $output .=  '<embed src="http://d.scribd.com/ScribdViewer.swf?document_id=' . $data['scribd_doc_id'] . '&amp;access_key=' . $data['scribd_access_key'] . '&amp;page=1&amp;version=1&amp;viewMode=" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" play="true" loop="true" scale="showall" wmode="opaque" devicefont="false" bgcolor="#FFFFFF" name="doc_' . $data['scribd_doc_id'] . '_object" menu="true" allowfullscreen="true" allowscriptaccess="always" salign="" type="application/x-shockwave-flash" align="middle" height="'. $height .'" width="100%">';
    $output .= '</object>';
    return $output;
  }
}
