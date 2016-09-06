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
    'files',
    'logout',
    'user'
  ];


  public function __construct($core, $args = []) {
    $this->core = $core;

    $this->init($this->elements($args['elements']));
  }

  protected function init($elements) {
    foreach($elements as $element) {
      $this->add($element);
    }
  }

  protected function add($element) {
    $class   = 'Kirby\panelBar\\' . ucfirst($element) . 'Element';

    if($path = kirby()->get('panelBar', $element)) {
      f::load($path . DS . $element . '.php');
      $element = new $class($this->core);
      $output  = $element->render();

    } elseif(is_callable($element)) {
      $element = $output = call_user_func($element);
    } else {
      $output = $element;
    }

    $this->core->html->add('elements', $output);
    $this->elements[] = $element;
  }

  protected function elements($elements) {
    return is_array($elements) ? $elements : c::get('plugin.panelBar.elements', static::$defaults);
  }

}
