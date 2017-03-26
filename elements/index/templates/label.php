<span class="<?php e($visible === false, 'panelBar-index--invisible') ?> panelBar-index--depth-<?= $depth ?>">
  <span class="panelBar-index__depth"><?= str_repeat('&nbsp;', $depth*3) ?></span>
  <?= $icon ?>
  <?= r($num !== null, '[') . $num . r($num !== null, '] ') ?>
  <?= $title ?>
</span>
