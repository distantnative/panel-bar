<div class="section">

  <h2 class="hgroup cf">
    <span><?= l('panelBar.view.configure') ?> <a href="<?php __(purl('plugin/panel-bar')) ?>">panelBar</a></span>
  </h2>


  <div class="panelBarView-grid">

    <div class="panelBarView-ELsection section white dashboard-section">
      <h2 class="hgroup hgroup-compressed hgroup-single-line cf">
        <span class="hgroup-title"><?= l('panelBar.view.elements') ?></span>

        <span class="hgroup-options shiv shiv-dark shiv-left">
          <span class="hgroup-option-right">
            <a title="Reset" href="<?= $bar->url('reset') ?>">
              <?php i('history', 'left') ?><span><?= l('panelBar.view.elements.reset') ?></span>
            </a>
          </span>
        </span>
      </h2>

      <?= $elements ?>
    </div>

    <?= $status ?>
    <?= $settings ?>

  </div>

</div>

<?= $assets ?>
