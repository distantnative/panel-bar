<div class="panelbar-files__list js-overlap">

  <?php foreach($items as $item) : ?>
      <a href="<?php echo $item['url'] ?>" class="panelbar-files__item panelbar-files__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'].'.'.$item['extension'] ?>">

        <div class="panelbar-files__preview">
          <div class="panelbar-files__image" <?php if($item['type'] === 'image' and isset($item['image'])) echo 'style="background-image:url(' . $item['image'] . ');"' ?>>

            <?php if($item['type'] !== 'image' and isset($item['icon'])) : ?>
              <div class="panelbar-files__icon"><i class="fa fa-<?php echo $item['icon'] ?>"></i></div>

            <?php endif ?>

            <div class="panelbar-files__overlay"></div>
          </div>

        </div>


        <span class="panelbar-files__label"><?php echo $item['label'] ?></span>
        <span class="panelbar-files__info">
          <span class="panelbar-files__extension"><?php echo $item['extension'] ?></span>
          <span class="panelbar-files__size"><?php echo $item['size'] ?></span>
        </span>
      </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelbar-files__more">
    All <?php echo $all['label'] ?>
  </a>
</div>
