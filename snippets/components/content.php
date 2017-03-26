<div class="panelBar-content">
  <?php if(is_string($content)) : ?>
    <?= $content ?>

  <?php else: ?>
    <?php foreach($content as $key => $value) : ?>
      <?php if($value === null) : ?>
        <hr />

      <?php elseif(!is_string($key)) : ?>
        <?= kirbytext($value) ?>

      <?php else : ?>
        <li class="key-<?= $key ?>">
          <b><?= $key ?></b>
          <?php if(is_array($value)) : ?>
            <a <?php e($value['url'], 'href="' . $value['url'] . '"') ?> <?php e(isset($value['external']), 'class="external"') ?>><?= $value['label'] ?></a>

          <?php else : ?>
            <span><?= $value ?></span>
          <?php endif ?>
        </li>
      <?php endif ?>
    <?php endforeach ?>
  <?php endif ?>
</div>
