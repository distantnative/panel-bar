<?php

namespace Kirby\Plugins\distantnative\panelBar;

use C;
use F;

class Elements {

  public static $defaults = [
    'panel',
    'panel',
    'add',
    'edit',
    'toggle',
    'images',
    'logout',
    'user'
  ];


  public function __construct($core, $args = []) {
    $this->core     = $core;
    $this->elements = is_array($args['elements']) ? $args['elements'] : c::get('plugin.panelBar.elements', static::$defaults);

    $this->hook();
  }

  public function hook() {
    foreach($this->elements as $id => $element) {
      // load element class
      $this->load($element);

      // get element's output
      $this->core->html->add('elements', $this->get($element, $id));
    }
  }

  protected function get($element, $id) {
    // $element is standard or plugin element
    if($class  = 'Kirby\Plugins\distantnative\panelBar\Elements\\' . $element and class_exists($class)) {
      return $this->getObject($class);
    }
  }

  protected function getObject($class) {
    $obj = new $class($this->core);
    return $obj->render();
  }


  protected function load($element) {
    if($class  = 'Kirby\Plugins\distantnative\panelBar\Elements\\' . $element and !class_exists($class)) {
      $root = dirname(__DIR__) . DS . '..' . DS;

      foreach([$root . 'elements', $root . 'plugins'] as $dir) {
        f::load($dir . DS . $element . '.php');
        f::load($dir . DS . $element . DS . $element . '.php');
      }
    }

  }

}
