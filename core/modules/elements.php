<?php

namespace Kirby\panelBar;

use C;
use Dir;
use F;

class Elements {

  public static $defaults = [
    'panel',
    'add',
    'edit',
    'visibility',
    'navigation',
    'files',
    'logout' => [
      'float' => 'right'
    ],
    'user' => [
      'float' => 'right'
    ]
  ];

  public function __construct($core, $args = []) {
    $this->core = $core;
    $this->init(self::active());
  }

  //====================================
  //   Add elements
  //====================================
  protected function init($elements) {
    foreach($elements as $element) {
      $this->add($element);
    }
  }

  protected function add($el) {
    if($path = kirby()->get('panelBar', $el)) {
      $nspace = 'Kirby\panelBar\\';
      $obj    = $nspace . ucfirst(str_replace('-', '', $el)) . 'Element';

      f::load($path . DS . $el . '.php');
      $el     = new $obj($this->core);
      $output = $el->render();

      $this->core->html->add('elements', $output);
      $this->elements[] = $el;
    }
  }

  //====================================
  //   Get elements
  //====================================
  public static function all($withPath = false) {
    $all = kirby()->get('panelBar');

    return $withPath ? $all : array_map(function($e) {
      return substr($e, strrpos($e, '/') + 1);
    }, $all);
  }

  public function active() {
    return $this->core->config->elements();
  }

}
