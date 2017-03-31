<div class="panelBar-files__list panelBar-mDrop">
  <?php foreach($items as $item) : ?>
    <a href="<?= $item['url'] ?>" class="panelBar-files__item panelBar-files--<?= $item['type'] ?>" title="<?= $item['label'].'.'.$item['extension'] ?>">

      <div class="panelBar-files__preview">
        <div class="panelBar-files__image" <?php e($item['type'] === 'image' and isset($item['image']), 'style="background-image:url(' . $item['image'] . ');"') ?>>
          <?php if($item['type'] !== 'image' and isset($item['icon'])) : ?>
            <div class="panelBar-files__icon"><?= $item['icon'] ?></div>
          <?php endif ?>
          <div class="panelBar-files__overlay"></div>
        </div>
      </div>

      <span class="panelBar-files__label"><?= $item['label'] ?></span>
      <span class="panelBar-files__info">
        <span class="panelBar-files__extension"><?= $item['extension'] ?></span>
        <span class="panelBar-files__size"><?= $item['size'] ?></span>
      </span>
    </a>
  <?php endforeach ?>

  <a href="<?= $all['url'] ?>" class="panelBar-files__more">
    <?= $all['label'] ?>
  </a>
</div>
