<div class="section">

  <h2 class="hgroup cf">
    <span>
      Configure <a href="<?php __(purl('plugin/panel-bar')) ?>">panelBar</a>
    </span>
  </h2>

  <div class="panelBarView-grid">

    <div class="panelBarView-ELsection section white dashboard-section">
      <h2 class="hgroup hgroup-compressed hgroup-single-line cf">
        <span class="hgroup-title">Elements</span>

        <span class="hgroup-options shiv shiv-dark shiv-left">
          <span class="hgroup-option-right">
            <a title="Reset" href="<?= $bar->url('reset') ?>">
              <?php i('history', 'left') ?><span>Reset to defaults</span>
            </a>
          </span>
        </span>
      </h2>


      <?= $elements ?>
    </div>

    

  </div>

</div>

<?= $assets ?>
