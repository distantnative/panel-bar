<div class="panelbar-images__grid <?php echo $count ?> js-overlap">

  <?php foreach($items as $item) : ?>
    <a href="<?php echo $item['url'] ?>" class="panelbar-images__item panelbar-images__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'] . '.' . $item['extension'] ?>">
      <div class="panelbar-images__preview">
        <div class="panelbar-images__image" style="background-image:url('<?php echo $item['image'] ?>');"></div>

        <div class="panelbar-images__overlay"></div>

        <span class="panelbar-images__info">
          <span class="panelbar-images__extension"><?php echo $item['extension'] ?></span>
          <span class="panelbar-images__size"><?php echo $item['size'] ?></span>
        </span>

        <span class="panelbar-images__label"><?php echo $item['label'] ?></span>
      </div>
    </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelbar-images__more">
    All <?php echo $all['label'] ?>
  </a>
</div>
