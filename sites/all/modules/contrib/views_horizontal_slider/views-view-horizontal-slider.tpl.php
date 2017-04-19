<?php

/**
 * @file views-view-horizontal-slider.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 * 
 */
?>
<div class="views_horizontal_slider views_horizontal_slider-<?php print $view->vid; ?> views_horizontal_slider-<?php print $view->vid; ?>-<?php print $options['counter']; ?>">

<div class="item-list">
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  
  <<?php print $options['type'];?>> 
  
  <?php //dsm($rows); ?>
  
    <?php foreach ($rows as $id => $row): ?>     
      <li class="<?php print 'hitem-' . $id; if ($id == 0) print " hslider-first"; if ($id == (count($rows)-1) ) print " hslider-last"; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
    
  </<?php print $options['type']; ?>>
   
  
</div>
  
</div>
