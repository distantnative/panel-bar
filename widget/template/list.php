<ul class="panelBar-widget__list" id="panelBar-widget-list">
  <?php foreach($active as $element) : ?>
    <?= tpl::load(__DIR__ . DS . 'entry.php', [
      'element' => $element,
      'checked' => true
    ]) ?>
  <?php endforeach ?>
  <?php foreach(array_diff($elements, $active) as $element) : ?>
    <?= tpl::load(__DIR__ . DS . 'entry.php', [
      'element' => $element,
      'checked' => false
    ]) ?>
  <?php endforeach ?>
</ul>
<style>
  <?= tpl::load(dirname(__DIR__) . DS . 'assets' . DS . 'css' . DS .  'widget.css') ?>
</style>
<script>
  var setURL = "<?= kirby()->urls()->index() ?>/api/plugin/panel-bar-widget/set";
  <?= tpl::load(dirname(__DIR__) . DS . 'assets' . DS . 'js' . DS .  'Sortable.min.js') ?>
  <?= tpl::load(dirname(__DIR__) . DS . 'assets' . DS . 'js' . DS .  'widget.min.js') ?>
</script>
