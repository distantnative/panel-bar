<div class="panelbar-filelist__list">

  <?php foreach($items as $item) : ?>
      <a href="<?php echo $item['url'] ?>" class="panelbar-filelist__item panelbar-filelist__item--<?php echo $item['type'] ?>" title="<?php echo $item['label'].'.'.$item['extension'] ?>">

        <div class="panelbar-filelist__preview">
          <?php if ($item['type'] == 'image') : ?>
            <div class="panelbar-filelist__image" style="background-image:url('<?php echo $item['image'] ?>');"></div>
          <?php else : ?>
            <div class="panelbar-filelist__image"></div>
          <?php endif ?>
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
