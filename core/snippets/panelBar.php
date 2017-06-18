
<?php $panelBar = new Kirby\panelBar\Core(); ?>

<?php if($user = site()->user() and $user->hasPanelAccess()) : ?>
  <div class="panelBar panelBar-reset <?= $panelBar->classes() ?>" id="panelBar">
    <?= $panelBar->pre() ?>
    <div class="panelBar-main" id="panelBar-main">
      <?= $panelBar->elements() ?>
    </div>
  </div>
  <?= $panelBar->controls() ?>
  <?= $panelBar->post() ?>
<?php else : ?>
  <?= $panelBar->login() ?>
<?php endif ?>
