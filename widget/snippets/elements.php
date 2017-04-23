<ul class="panelBarView-elements">
  <?php foreach($bar->elements() as $element) : ?>
    <?= $controller->view('snippets/element', [
      'element' => $element,
      'checked' => in_array($element, $bar->active()),
      'float'   => a::get($bar->element($element), 'float', in_array($element, $bar->active()) ? 'left' : null)
    ]) ?>
  <?php endforeach ?>
</ul>
