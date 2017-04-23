
<div class="section white dashboard-section">
  <h2 class="hgroup hgroup-compressed hgroup-single-line cf">
    <span class="hgroup-title">Status</span>
  </h2>

  <ul class="nav nav-list sidebar-list">
    <li>
        <span>Version</span>
        <small class="marginalia"><?= Kirby\panelBar\Core::$version ?></small>
    </li>

    <li>
        <span>Custom Elements</span>
        <small class="marginalia"><?= count($bar->custom()) ?></small>
    </li>
  </ul>
</div>
