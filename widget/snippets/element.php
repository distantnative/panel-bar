<li class="item panelBarView-element <?php e(!$checked, 'panelBarView-element--fixed') ?>">

  <label class="item">
    <input type="checkbox" <?php e($checked, 'checked="checked"') ?> name="panelbar[]" value="<?= $element ?>" />

    <div class="icons">
      <?= i('square-o') ?>
      <?= i('check-square-o') ?>
      <?= i('check-square') ?>
    </div>

    <span class="name"><?= ucfirst($element) ?></span>
  </label>


  <div class="controls">
    <span class="float" data-float="<?= $float ?>">
      <a href="#" data-float="left" title="Make element float left"><?= i('align-left') ?></a>&nbsp;&nbsp;&nbsp;<a href="#" data-float="right" title="Make element float right"><?= i('align-right') ?></a>
    </span>
    <span class="handles"><?= i('reorder') ?></span>
  </div>
</li>
