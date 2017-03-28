<?php

namespace Kirby\panelBar;

use C;
use Dir;
use F;
use Yaml;

class Elements {

  public static $defaults = [
    'panel',
    'add',
    'edit',
    'visibility',
    'navigation',
    'files',
    'logout',
    'user'
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

  public static function active() {
    $config = f::exists(self::config()) ? yaml::read(self::config()) : [];
    return count($config) > 0 ? $config : c::get('panelBar.elements', static::$defaults);
  }

  //====================================
  //   Define elements set
  //====================================
  public static function set($elements = []) {
    return yaml::write(self::config(), $elements);
  }

  public static function clear() {
    return f::remove(self::config());
  }

  //====================================
  //   Config for element set
  //====================================
  public static function config() {
    return kirby()->roots()->config() . DS . 'panelBar.yml';
  }

}
