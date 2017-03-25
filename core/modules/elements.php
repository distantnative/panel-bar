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

  protected function add($element) {
    $class   = 'Kirby\panelBar\\' . ucfirst(str_replace('-', '', $element)) . 'Element';

    if($path = kirby()->get('panelBar', $element)) {
      f::load($path . DS . $element . '.php');
      $element = new $class($this->core);
      $output  = $element->render();

      $this->core->html->add('elements', $output);
      $this->elements[] = $element;
    }
  }

  public static function all() {
    return array_map(function($e) {
      return substr($e, strrpos($e, '/') + 1);
    }, kirby()->get('panelBar'));
  }

  //====================================
  //   Settings
  //====================================
  public static function active() {
    $config = yaml::read(self::config());

    if(f::exists(self::config()) and count($config) > 0) {
      return $config;
    } else {
      return c::get('panelBar.elements', static::$defaults);
    }
  }

  public static function set($elements = []) {
    return yaml::write(self::config(), $elements);
  }

  public static function clear() {
    return f::remove(self::config());
  }

  public static function config() {
    return kirby()->roots()->config() . DS . 'panelBar.yml';
  }

}
