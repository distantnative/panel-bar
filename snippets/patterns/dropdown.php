
<div class="panelBar-drop__list panelBar-mDrop">
  <?php foreach($items as $item) : ?>

    <?php if(isset($item['url'])) : ?>
      <a href="<?= $item['url'] ?>" class="panelBar-drop__item <?php e(isset($item['external']), 'external') ?>" title="<?= isset($item['title']) ? $item['title'] : '' ?>">
    <?php else : ?>
      <span class="panelBar-drop__item" title="<?= isset($item['title']) ? $item['title'] : '' ?>">
    <?php endif ?>

    <?= $item['label'] ?>

    <?php if(isset($item['url'])) : ?>
      </a>
    <?php else : ?>
      </span>
    <?php endif ?>

  <?php endforeach ?>
</div>
