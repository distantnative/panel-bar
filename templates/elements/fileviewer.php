<div class="panelbar-fileviewer__grid <?php echo $count ?> js-overlap">

  <?php foreach($items as $item) : ?>
    <a href="<?php echo $item['url'] ?>" class="panelbar-fileviewer__item panelbar-fileviewer__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'] . '.' . $item['extension'] ?>">
      <div class="panelbar-fileviewer__preview">
        <?php if ($item['type'] == 'image') : ?>
          <div class="panelbar-fileviewer__image" style="background-image:url('<?php echo $item['image'] ?>');"></div>
        <?php endif ?>

        <div class="panelbar-fileviewer__overlay"></div>

        <span class="panelbar-fileviewer__info">
          <span class="panelbar-fileviewer__extension"><?php echo $item['extension'] ?></span>
          <span class="panelbar-fileviewer__size"><?php echo $item['size'] ?></span>
        </span>

        <span class="panelbar-fileviewer__label"><?php echo $item['label'] ?></span>
      </div>
    </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelbar-fileviewer__more">
    All <?php echo $all['label'] ?>
  </a>
</div>
