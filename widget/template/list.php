<ul class="panelBar-widget__list">
  <?php foreach(a::merge($active, array_diff($el, $active)) as $element) : ?>
    <?= tpl::load(__DIR__ . DS . 'entry.php', [
      'element' => $element,
      'checked' => in_array($element, $active),
      'float'   => a::get($config->element($element), 'float', in_array($element, $active) ? 'left' : null)
    ]) ?>
  <?php endforeach ?>
</ul>
<style>
  <?= tpl::load($assets . DS . 'css' . DS .  'widget.css') ?>
</style>
<script>
  var setPanelBarURL = "<?= $url ?>";
  <?= tpl::load($assets . DS . 'js' . DS .  'Sortable.min.js') ?>
  <?= tpl::load($assets . DS . 'js' . DS .  'widget.min.js') ?>
</script>
