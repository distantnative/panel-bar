<div class="panelBar-files__list panelBar-mDrop">
  <?php foreach($items as $item) : ?>
  <a href="<?php echo $item['url'] ?>" class="panelBar-files__item panelBar-files--<?php echo $item['type'] ?>" title="<?php echo $item['label'].'.'.$item['extension'] ?>">
    <div class="panelBar-files__preview">
      <div class="panelBar-files__image" <?php if($item['type'] === 'image' and isset($item['image'])) echo 'style="background-image:url(' . $item['image'] . ');"' ?>>
        <?php if($item['type'] !== 'image' and isset($item['icon'])) : ?>
          <div class="panelBar-files__icon"><i class="fa fa-<?php echo $item['icon'] ?>"></i></div>
        <?php endif ?>
        <div class="panelBar-files__overlay"></div>
      </div>
    </div>
    <span class="panelBar-files__label"><?php echo $item['label'] ?></span>
    <span class="panelBar-files__info">
      <span class="panelBar-files__extension"><?php echo $item['extension'] ?></span>
      <span class="panelBar-files__size"><?php echo $item['size'] ?></span>
    </span>
  </a>
  <?php endforeach ?>

  <a href="<?php echo $all['url'] ?>" class="panelBar-files__more">All <?php echo $all['label'] ?></a>
</div>
