<div class="panelbar-element <?php echo $class ?> panelbar--<?php echo $id ?>" id="panelbar--<?php echo $id ?>">

  <?php if($url) : ?>
    <a href="<?php echo $url ?>">
  <?php else : ?>
    <span>
  <?php endif ?>


    <?php if($icon) : ?>
      <i class="fa fa-<?php echo $icon ?> <?php echo r($mobile == 'label', 'not-mobile') ?>"></i>
    <?php endif ?>

    <?php if($label) : ?>
      <span class="<?php echo r($mobile == 'icon', 'not-mobile') ?>"><?php echo $label ?></span>
    <?php endif ?>


  <?php if($url) : ?>
    </a>
  <?php else : ?>
    </span>
  <?php endif ?>

  <?php echo $content ?>
</div>
