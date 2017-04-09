<li class="item">
  <input type="checkbox" <?php e($checked, 'checked="checked"') ?> name="panelbar[]" value="<?= $element ?>" />
  <?= ucfirst($element) ?>
  <span class="floats">
    <a href="#" class="<?php e($float === 'left', 'active') ?>" data-float="left" title="Make element float left">L</a> | <a href="#" class="<?php e($float === 'right', 'active') ?>" data-float="right" title="Make element float right">R</a>
  </span>
  <span class="handles"></span>
</li>
