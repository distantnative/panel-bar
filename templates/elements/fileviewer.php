<div class="panelbar-fileviewer__grid panelbar-fileviewer__grid--<?php echo $count ?>" <?php echo $style ?>>

  <div class="panelbar-fileviewer__items">
    <?php foreach($items as $item) : ?>
      <a href="<?php echo $item['url'] ?>" class="panelbar-fileviewer__item panelbar-fileviewer__item--<?php echo $item['type'] ?>">
        <div class="panelbar-fileviewer__preview">

          <?php if ($item['type'] == 'image') : ?>
            <div class="panelbar-fileviewer__image" style="background-image:url('<?php echo $item['image'] ?>');"></div>
          <?php endif ?>

          <em>
            <?php echo $item['extension'] ?>
          </em>

          <span class="panelbar-fileviewer__label">
            <?php echo $item['label'] ?>
          </span>

        </div>

      </a>
    <?php endforeach ?>
  </div>

  <a href="<?php echo $all['url'] ?>" class="panelbar-fileviewer__more">
    All <?php echo $all['label'] ?>
  </a>

</div>
