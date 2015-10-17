<div class="panelBar-element <?php echo $class ?> panelBar--<?php echo $id ?> <?php echo r($mobile === false, 'not-mobile') ?> <?php echo r($compact === false, 'not-compact') ?>" id="panelBar--<?php echo $id ?>">
  <?php if($url) : ?>
    <a href="<?php echo $url ?>" title="<?php echo $title ?>">
  <?php elseif($icon or $label) : ?>
    <span title="<?php echo $title ?>">
  <?php endif ?>
  <?php if($icon) : ?>
    <i class="fa fa-<?php echo $icon ?> <?php echo r($mobile == 'label', 'not-mobile') ?>"></i>
  <?php endif ?>
  <?php if($label) : ?>
    <span class="<?php echo r($mobile == 'icon', 'not-mobile') ?>"><?php echo $label ?></span>
  <?php endif ?>
  <?php if($url) : ?>
    </a>
  <?php elseif($icon or $label) : ?>
    </span>
  <?php endif ?>

  <?php echo $content ?>
</div>
