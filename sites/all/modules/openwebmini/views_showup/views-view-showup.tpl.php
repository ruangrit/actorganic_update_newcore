<?php
?>

<ul id="<?php print $views_showup_id ?>" class="views-showup clear-block">
<?php foreach ($rows as $id => $row): ?> 
  <li class="showup-item" id="showup-item-<?php print $id + 1; ?>"><div><?php print $row; ?></div></li>
<?php endforeach; ?>
</ul>
