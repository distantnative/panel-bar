<ul class="panelBar-widget__list">
  <?php foreach(a::merge($active, array_diff($el, $active)) as $element) : ?>
    <?= tpl::load(__DIR__ . DS . 'entry.php', [
      'element' => $element,
      'checked' => in_array($element, $active)
    ]) ?>
  <?php endforeach ?>
</ul>
<style>
  <?= tpl::load($assets . 'css' . DS .  'widget.css') ?>
</style>
<script>
  var setURL = "<?= $url ?>";
  <?= tpl::load($assets . 'js' . DS .  'Sortable.min.js') ?>
  <?= tpl::load($assets . 'js' . DS .  'widget.min.js') ?>
</script>
