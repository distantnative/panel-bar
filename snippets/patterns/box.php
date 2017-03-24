<div class="panelBar-box__content panelBar-mDrop">
  <?php if(is_string($box)) : ?>
    <?= $box ?>
  <?php else: ?>
    <?php if($box['style'] === 'keyvalue') : ?>
      <ul class="panelBar-box__content--keyvalue">
        <?php foreach($box['content'] as $key => $value) : ?>
          <?php if($value === null) : ?>
            <hr />
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
      </ul>
    <?php endif ?>
  <?php endif ?>
</div>
