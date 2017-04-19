<?php

/**
 * Implementation of views_plugin_style().
 */
class views_showup_style_plugin extends views_plugin_style {

  function option_definition() {
    $options = parent::option_definition();
    unset($options['grouping']);

    $options['views_showup_effect_speed'] = array('default' => 400);
    $options['views_showup_effect_speed_custom'] = array('default' => '');
    $options['views_showup_on_top_field'] = array('default' => 'title');
    $options['views_showup_field_url'] = array('default' => '');

    return $options;
  }

  // Default values.
  function options(&$options) {
    $options['views_showup_effect_speed'] = 400;
    $options['views_showup_effect_speed_custom'] = '';
    $options['views_showup_on_top_field'] = 'title';
    $options['views_showup_field_url'] = '';
  }

  function options_form(&$form, &$form_state) {
    $form['views_showup_effect_speed'] = array(
      '#type' => 'select',
      '#title' => t('Effect speed'),
      '#default_value' => $this->options['views_showup_effect_speed'],
      '#options' => array(
        '800' => t('very slow'),
        '600' => t('slow'),
        '400' => t('normal'),
        '200' => t('fast'),
        '100' => t('very fast'),
        'custom' => t('custom'),
      ),
    );
    $form['views_showup_effect_speed_custom'] = array(
      '#type' => 'textfield',
      '#title' => t('Effect speed custom'),
      '#default_value' => $this->options['views_showup_effect_speed_custom'],
      '#description' => t('Enter speed in milliseconds.'),
      '#size' => 10,
    );
    
    $fields = array();
    foreach ($this->display->handler->get_handlers('field') as $field => $handler) {
      if ($label = $handler->label()) {
        $fields[$field] = $label;
      }   
      else {
        $fields[$field] = $handler->ui_name();
      }   
    }
    $form['views_showup_on_top_field'] = array(
      '#type' => 'select',
      '#title' => t('On top field'),
      '#default_value' => $this->options['views_showup_on_top_field'],
      '#description' => t('This field always display.'),
      '#options' => $fields,
    );
    $defaults = array('' => t('Do not use URL'));
    $fields = array_merge($defaults, $fields);
    $form['views_showup_field_url'] = array(
      '#type' => 'select',
      '#title' => t('URL'),
      '#default_value' => $this->options['views_showup_field_url'],
      '#description' => t('Leave blank if you do not want to make link.'),
      '#options' => $fields,
    );
  }
  
  function options_validate(&$form, &$form_state) {
    $values = $form_state['values']['style_options'];
    if ($values['views_showup_effect_speed'] == 'custom') {
      if ($values['views_showup_effect_speed_custom'] == '') {
        form_set_error('views_showup_effect_speed_custom', t('Please enter effect speed custom.'));
      }
      elseif (!is_numeric($values['views_showup_effect_speed_custom'])) {
        form_set_error('views_showup_effect_speed_custom', t('Effect speed custom must be integer.'));
      }
    }
  }
}
