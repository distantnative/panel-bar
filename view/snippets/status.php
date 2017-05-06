
<div class="section white dashboard-section">
  <h2 class="hgroup hgroup-compressed hgroup-single-line cf">
    <span class="hgroup-title"><?= l('panelBar.view.status') ?></span>
  </h2>

  <ul class="nav nav-list sidebar-list">
    <li>
        <span><?= l('panelBar.view.version') ?></span>
        <small class="marginalia"><?= Kirby\panelBar\Core::$version ?></small>
    </li>

    <li>
        <span><?= l('panelBar.view.status.custom') ?></span>
        <small class="marginalia"><?= count($bar->custom()) ?></small>
    </li>
  </ul>
</div>
