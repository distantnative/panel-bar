<div class="panelbar-filelist__list js-overlap">

  <?php foreach($items as $item) : ?>
      <a href="<?php echo $item['url'] ?>" class="panelbar-filelist__item panelbar-filelist__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'].'.'.$item['extension'] ?>">

        <div class="panelbar-filelist__preview">
          <div class="panelbar-filelist__image" <?php if($item['type'] === 'image' and isset($item['image'])) echo 'style="background-image:url(' . $item['image'] . ');"' ?>>

            <?php if($item['type'] !== 'image' and isset($item['icon'])) : ?>
              <div class="panelbar-filelist__icon"><i class="fa fa-<?php echo $item['icon'] ?>"></i></div>

            <?php endif ?>

            <div class="panelbar-filelist__overlay"></div>
          </div>

        </div>


        <span class="panelbar-filelist__label"><?php echo $item['label'] ?></span>
        <span class="panelbar-filelist__info">
          <span class="panelbar-filelist__extension"><?php echo $item['extension'] ?></span>
          <span class="panelbar-filelist__size"><?php echo $item['size'] ?></span>
        </span>
      </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelbar-filelist__more">
    All <?php echo $all['label'] ?>
  </a>
</div>
