<div class="section white dashboard-section">
  <h2 class="hgroup hgroup-compressed hgroup-single-line cf">
    <span class="hgroup-title"><?= l('panelBar.view.settings') ?></span>
  </h2>

  <ul class="nav nav-list sidebar-list">
    <li>
        <span>panelBar.position</span>
        <small class="marginalia"><?= c::get('panelBar.position', 'top') ?></small>
    </li>

    <li>
        <span>panelBar.login</span>
        <small class="marginalia"><?= c::get('panelBar.login', false) ? 'true' : 'false'; ?></small>
    </li>

    <li>
        <span>panelBar.keys</span>
        <small class="marginalia"><?= c::get('panelBar.keys', false) ? 'true' : 'false'; ?></small>
    </li>
  </ul>

  <a href="https://github.com/distantnative/panel-bar" class="panelBarView-link"><?= l('panelBar.view.docs') ?></a>
</div>
