<ul class="panelBar-box__content panelBar-mDrop">
  <?php if(is_string($box)) : ?>
    <?= $box ?>
  <?php else: ?>
    <?php foreach($box as $key => $value) : ?>
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
</ul>
