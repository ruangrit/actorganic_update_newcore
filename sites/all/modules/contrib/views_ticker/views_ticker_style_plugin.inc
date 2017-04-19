<?php
// $Id$

/**
 * @file
 * Define a settings form for view_ticker in Views. This file is autoloaded by views.
 */

/**
 * Implementation of views_plugin_style().
 */
class views_ticker_style_plugin extends views_plugin_style {
  // defaults
  function options(&$options) {
    $options['scroller_type'] = 'horizontal';
    $options['hscroller_speed'] = 30;
    $options['hscroller_direction'] = 'left';
    $options['hscroller_mouseover'] = 0;
    $options['hscroller_delay'] = 0;
    $options['hscroller_bounce'] = 0;
    $options['vscroller_speed'] = 30;
    $options['vscroller_direction'] = 'up';
    $options['vscroller_mouseover'] = 0;
    $options['vscroller_delay'] = 0;
    $options['vscroller_bounce'] = 0;
  }

  function options_form(&$form, &$form_state) {
    $form['scroller_type'] = array(
      '#type' => 'select',
      '#title' => t('Scroller type'),
      '#description' => t(''),
      '#default_value' => $this->options['scroller_type'],
      '#options' => array(
        'horizontal' => t('Horizontal'),
        'vertical' => t('Vertical'),
        'fade' => t('Fade'),
        'bbc' => t('BBC'),
      ),
    );
    // horizontal
    $form['hscroller_speed'] = array(
      '#type' => 'select',
      '#title' => t('Horizontal scroller speed'),
      '#description' => t(''),
      '#default_value' => $this->options['hscroller_speed'],
      '#options' => array(
        '10' => t('Very slow'),
        '20' => t('Slow'),
        '30' => t('Normal'),
        '40' => t('Fast'),
        '50' => t('Very fast'),
      ),
    );
    $form['hscroller_direction'] = array(
      '#type' => 'select',
      '#title' => t('Horizontal scroller direction'),
      '#description' => t(''),
      '#default_value' => $this->options['hscroller_direction'],
      '#options' => array(
        'left' => t('Left'),
        'right' => t('Right'),
      ),
    );
    $form['hscroller_delay'] = array(
      '#type' => 'select',
      '#title' => t('Horizontal scroller delay'),
      '#description' => t(''),
      '#default_value' => $this->options['hscroller_delay'],
      '#options' => array(
        '0' => t('None'),
        '1' => t('One second'),
        '2' => t('Two seconds'),
        '3' => t('Three seconds'),
        '4' => t('Four seconds'),
        '5' => t('Five seconds'),
        '10' => t('Ten seconds'),
      ),
    );
    $form['hscroller_mouseover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Horizontal scroller mouseover'),
      '#description' => t(''),
      '#default_value' => $this->options['hscroller_mouseover'],
    );
    $form['hscroller_bounce'] = array(
      '#type' => 'checkbox',
      '#title' => t('Horizontal scroller bounce'),
      '#description' => t(''),
      '#default_value' => $this->options['hscroller_bounce'],
    );
    // vertical
    $form['vscroller_speed'] = array(
      '#type' => 'select',
      '#title' => t('Vertical scroller speed'),
      '#description' => t(''),
      '#default_value' => $this->options['vscroller_speed'],
      '#options' => array(
        '10' => t('Very slow'),
        '20' => t('Slow'),
        '30' => t('Normal'),
        '40' => t('Fast'),
        '50' => t('Very fast'),
      ),
    );
    $form['vscroller_direction'] = array(
      '#type' => 'select',
      '#title' => t('Vertical scroller direction'),
      '#description' => t(''),
      '#default_value' => $this->options['vscroller_direction'],
      '#options' => array(
        'up' => t('Up'),
        'down' => t('Down'),
      ),
    );
    $form['vscroller_delay'] = array(
      '#type' => 'select',
      '#title' => t('Vertical scroller delay'),
      '#description' => t(''),
      '#default_value' => $this->options['vscroller_delay'],
      '#options' => array(
        '0' => t('None'),
        '1' => t('One second'),
        '2' => t('Two seconds'),
        '3' => t('Three seconds'),
        '4' => t('Four seconds'),
        '5' => t('Five seconds'),
        '10' => t('Ten seconds'),
      ),
    );
    $form['vscroller_mouseover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Vertical scroller mouseover'),
      '#description' => t(''),
      '#default_value' => $this->options['vscroller_mouseover'],
    );
    $form['vscroller_bounce'] = array(
      '#type' => 'checkbox',
      '#title' => t('Vertical scroller bounce'),
      '#description' => t(''),
      '#default_value' => $this->options['vscroller_bounce'],
    );
  }
}
