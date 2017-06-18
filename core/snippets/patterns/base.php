<div class="panelBar-element <?= $class ?> <?= $float === 'right' ? 'panelBar-element--right' : '' ?> responsive--<?= $mobile ?> panelBar--<?= $id ?>"  id="panelBar--<?= $id ?>">
  <?php if($url) : ?>
    <a href="<?= $url ?>" title="<?= $title ?>">
  <?php elseif($icon or $label) : ?>
    <span title="<?= $title ?>">
  <?php endif ?>

    <?php if($icon) : ?>
      <i class="fa fa-<?= $icon ?>"></i>
    <?php endif ?>

    <?php if($label) : ?>
      <span><?= $label ?></span>
    <?php endif ?>

  <?php if($url) : ?>
    </a>
  <?php elseif($icon or $label) : ?>
    </span>
  <?php endif ?>

  <?= $content ?>
</div>
