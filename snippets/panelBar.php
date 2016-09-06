
<?php
$panelBar = new Kirby\panelBar\Core([
  'elements' => isset($elements) ? $elements : null,
]);
?>


<?php if($panelBar->isShown() and !get('hidePanelBar')) : ?>

  <div class="panelBar <?= $panelBar->classes() ?>" id="panelBar">
    <?= $panelBar->pre() ?>
    <div class="panelBar-main" id="panelBar-main">
      <?= $panelBar->elements() ?>
    </div>
  </div>
  <?= $panelBar->controls() ?>
  <?= $panelBar->post() ?>

<?php endif ?>
