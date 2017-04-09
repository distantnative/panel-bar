<?php

namespace Kirby\panelBar;

use A;
use Tpl;

class Pattern {

  public static $classes;

  public function __construct($element) {
    $this->core     = $element->core;
    $this->element  = $element;
  }

  protected function base($args) {
    return $this->core->html->load('patterns' . DS . 'base', a::merge([
      'id'      => $this->element,
      'class'   => self::classes(),
      'url'     => null,
      'label'   => null,
      'icon'    => null,
      'mobile'  => 'icon',
      'content' => null,
      'title'   => isset($args['label']) ? strip_tags($args['label']) : null,
      'float'   => a::get($this->core->config->element($this->element), 'float', 'left')
    ], $args));
  }

  protected function tpl($pattern, $args = []) {
    return $this->core->html->load('patterns' . DS . $pattern, $args);
  }

  protected function asset($type, $asset) {
    $asset = $this->core->assets->link($type, $asset);
    $this->core->assets->add($type, $asset);
  }

  public static function classes($additional = '') {
    return static::$classes . ' ' . $additional;
  }

}
