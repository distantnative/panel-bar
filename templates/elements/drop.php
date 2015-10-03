<div class="panelbar-drop__list">
  <?php foreach($items as $item) : ?>

    <?php if(isset($item['url'])) : ?>
      <a href="<?php echo $item['url'] ?>" class="panelbar-drop__item">
    <?php else : ?>
      <span  class="panelbar-drop__item">
    <?php endif ?>

      <?php echo $item['label'] ?>

    <?php if(isset($item['url'])) : ?>
      </a>
    <?php else : ?>
      </span>
    <?php endif ?>

  <?php endforeach ?>
</div>
