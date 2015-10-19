<div class="panelBar-images__grid panelBar-mDrop <?php echo $count ?>">
  <?php foreach($items as $item) : ?>
  <a href="<?php echo $item['url'] ?>" class="panelBar-images__item panelBar-images__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'] . '.' . $item['extension'] ?>">
    <div class="panelBar-images__preview">
      <div class="panelBar-images__image" style="background-image:url('<?php echo $item['image'] ?>');"></div>
      <div class="panelBar-images__overlay"></div>
      <span class="panelBar-images__info">
        <span class="panelBar-images__extension"><?php echo $item['extension'] ?></span>
        <span class="panelBar-images__size"><?php echo $item['size'] ?></span>
      </span>
      <span class="panelBar-images__label"><?php echo $item['label'] ?></span>
    </div>
  </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelBar-images__more">All <?php echo $all['label'] ?></a>
</div>
