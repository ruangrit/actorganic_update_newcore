<?php
// $Id: views_horizontal_slider_plugin_style_slider.inc,v 1.2 2010/07/31 12:56:58 eanima Exp $

/**
 * @file
 * Views settings, output and data validation
  
 */


class views_horizontal_slider_plugin_style_slider extends views_plugin_style_list {
  
  //default options
  function option_definition() {
    $options = parent::option_definition();

    $options['animate_in'] =  array('default' => 400);
    $options['animate_out'] =  array('default' => 400);
    $options['min_width'] = array('default' => 134);
    $options['max_width'] =  array('default' => 195);
    $options['start_id'] =  array('default' => 0);   
    return $options;
  }

function options_form(&$form, &$form_values) {
  parent::options_form($form, $form_values);

  unset($form['grouping']);
  unset($form['type']);

  $form['animate_in'] = array(
    '#type' => 'textfield',
    '#title' => t('Animate In'),
    '#required' => TRUE,
    '#description' => t('Specify the Animation In Speed'),
    '#default_value' => $this->options['animate_in'],
    );
  $form['animate_out'] = array(
    '#type' => 'textfield',
    '#title' => t('Animate Out'),
    '#required' => TRUE,
    '#description' => t('Specify the Animation Out Speed'),
    '#default_value' => $this->options['animate_out'],
    );
  $form['min_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Min Width'),
    '#required' => TRUE,
    '#description' => t('Minimum width of an image/item'),
    '#default_value' => $this->options['min_width'],
    );
  $form['max_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Max Width'),
    '#required' => TRUE,
    '#description' => t('Maximum width of an image/item'),
    '#default_value' => $this->options['max_width'],
    );
  $form['start_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Start Position'),
    '#required' => TRUE,
    '#description' => t('Position of default maximized image/item. First one has position 0.'),
    '#default_value' => $this->options['start_id'],
    );    
  }

//Validating the inputs

function options_validate($form, &$form_state) {
  parent::options_validate($form, $form_state);
  $options = &$form_state['values']['style_options'];
  
  if (!is_numeric($options['max_width'])) {
    form_error($form['max_width'], t('Please specify a numerical value for Max Width'));
  }
  if (!is_numeric($options['min_width'])) {
      form_error($form['min_width'], t('Please specify a numerical value for Min Width'));
  }
  if (!is_numeric($options['animate_in'])) {
      form_error($form['animate_in'], t('Please specify a numerical value for Animate In'));
  }
  if (!is_numeric($options['animate_out'])) {
    form_error($form['animate_out'], t('Please specify a numerical value for Animate Out'));
  }
  if (!is_numeric($options['start_id'])) {
    form_error($form['start_id'], t('Please specify a numerical value for Start Position'));
  }
}

//Render the output  

function render() {
  static $counter;
  // @TODO: Keep count of number of rendered views per page
  $counter[$this->view->vid]++;
  drupal_add_css(drupal_get_path('module', 'views_horizontal_slider') . '/views_horizontal_slider.css');
  views_horizontal_slider_add_js($this->options);

  // Group the rows according to the grouping field, if specified.
  $sets = $this->render_grouping($this->view->result, $this->options['grouping']);
  $this->options['counter'] = $counter[$this->view->vid];
  
  // Render each group separately and concatenate.  Plugins may override this
  // method if they wish some other way of handling grouping.
  $output = $view_output = '';
  $this->view->row_index = 0;
  
  foreach ($sets as $title => $records) { //$title is empty
    
    if ($this->uses_row_plugin()) {
      $rows = array();
      
      foreach ($records as $label => $row) {
        
        //$row is the full object with all fields
        $rows[] = $this->row_plugin->render($row);
        $this->view->row_index++;
      }
    }
    else {
      $rows = $records;
    }

    $view_output .= theme($this->theme_functions(), $this->view, $this->options, $rows, $title);
  }
  if (!is_null($view_output)) {
    $output .= $view_output;
  }
  
  return $output;
  }
}

