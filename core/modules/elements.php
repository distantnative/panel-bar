<?php

namespace Kirby\panelBar;

use C;
use F;

class Elements {

  public static $defaults = [
    'panel',
    'add',
    'edit',
    'toggle',
    'images',
    'logout',
    'user'
  ];


  public function __construct($core, $args = []) {
    $this->core = $core;
    $this->init($this->elements($args['elements']));
  }

  protected function init($elements) {
    foreach($elements as $element) {
      $this->element($element);
    }
  }

  protected function element($element) {
    if($path = kirby()->get('panelBar', $element)) {
      $this->core->html->add('elements', $this->load($element, $path)->render());
      $this->elements[] = $element;
    }
  }

  protected function load($element, $path) {
    f::load($path . DS . $element . '.php');

    $class  = 'Kirby\panelBar\\' . ucfirst($element) . 'Element';
    return new $class($this->core);
  }

  protected function elements($elements) {
    return is_array($elements) ? $elements : c::get('plugin.panelBar.elements', static::$defaults);
  }

}
