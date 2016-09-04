
<?php
$panelBar = new Kirby\distantnative\panelBar\Core([
  'elements' => isset($elements) ? $elements : null,
]);

if($panelBar->isShown()) :
?>

  <div class="panelBar <?= $panelBar->classes() ?>" id="panelBar">
    <?= $panelBar->pre() ?>
    <div class="panelBar-main" id="panelBar-main">
      <?= $panelBar->elements() ?>
    </div>
  </div>
  <?= $panelBar->controls() ?>
  <?= $panelBar->post() ?>

<?php endif ?>
