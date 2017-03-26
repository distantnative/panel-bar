
<div class="panelBar-drop__list panelBar-mDrop">
  <?php foreach($items as $item) : ?>

    <?php if(isset($item['url'])) : ?>
      <a href="<?= $item['url'] ?>" class="panelBar-drop__item <?= isset($item['class']) ? $item['class'] : '' ?> <?php e(isset($item['external']), 'external') ?>" title="<?= isset($item['title']) ? $item['title'] : strip_tags($item['label']) ?>">
    <?php else : ?>
      <span class="panelBar-drop__item <?= isset($item['class']) ? $item['class'] : '' ?>" title="<?= isset($item['title']) ? $item['title'] : strip_tags($item['label']) ?>">
    <?php endif ?>

    <?= $item['label'] ?>

    <?php if(isset($item['url'])) : ?>
      </a>
    <?php else : ?>
      </span>
    <?php endif ?>

  <?php endforeach ?>
</div>
