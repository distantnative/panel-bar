<div class="panelBar-images__grid panelBar-mDrop items--<?= $count ?>">
  <div class="grid">
    <?php foreach($items as $item) : ?>
    <a href="<?= $item['url'] ?>" class="panelBar-images__item panelBar-images__item--image" title="<?= $item['label'] . '.' . $item['extension'] ?>">
      <div class="panelBar-images__preview">
        <div class="panelBar-images__image" style="background-image:url('<?= $item['image'] ?>');"></div>
        <div class="panelBar-images__overlay"></div>
        <span class="panelBar-images__info">
          <span class="panelBar-images__extension"><?= $item['extension'] ?></span>
          <span class="panelBar-images__size"><?= $item['size'] ?></span>
        </span>
        <span class="panelBar-images__label"><?= $item['label'] ?></span>
      </div>
    </a>
    <?php endforeach ?>
  </div>

  <a href="<?= $all['url'] ?>" class="panelBar-images__more">
    <?= $all['label'] ?>
  </a>
</div>
