<span class="<?php e($visible === false, 'panelBar-index--invisible') ?> panelBar-index--depth-<?= $depth ?>">
  <span class="panelBar-index__depth"><?= str_repeat('–', $depth) ?></span>
  <?= r($num !== null, '[') . $num . r($num !== null, '] ') ?>
  <?= $title ?>
</span>
