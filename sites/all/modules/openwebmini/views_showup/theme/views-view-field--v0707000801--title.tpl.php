<?php

$settings = $view->display['default']->handler->options['style_options'];
if ($field = $settings['views_showup_field_url']) {
  $field = $view->display[$view->current_display]->handler->handlers['field'][$field];
  $field_alias = $field->table .'_'. $field->field;
  if (!empty($row->{$field_alias})) {
    $output = l($row->node_title, $row->{$field_alias});
  }
}
print $output;
