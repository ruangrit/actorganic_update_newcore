<?php

/** 
 * Admin settings.
 */
function custom_settings_admin() {
  $result = db_query("SELECT * FROM {custom_settings_path} ORDER BY cid ASC");
  while ($row = db_fetch_object($result)) {
    $form[$row->cid]['path'] = array('#value' => $row->path);
    $form[$row->cid]['field'] = array('#value' => l(t('Fields'), 'admin/build/custom_settings/'. $row->cid .'/fields'));
  }
  return system_setings_form($form);
}

/**
 * Settings a fields.
 */
function custom_settings_fields($form_state, $cid) {
}

/** 
 * Remove path.
 */
function custom_settings_remove_path($form_state, $cid) {
}

/**
 * Remove field.
 */
function custom_settings_remove_field($form_state, $cid, $fid) {
}
