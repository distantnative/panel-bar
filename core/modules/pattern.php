<?php

namespace Kirby\panelBar;

use A;
use Tpl;

class Pattern {

  public function __construct($element) {
    $this->core     = $element->core;
    $this->element  = $element;
  }

  protected function asset($type, $asset) {
    $asset = $this->core->assets->link($type, $asset);
    $this->core->assets->add($type, $asset);
  }

  protected function tpl($pattern, $args = []) {
    $root    = $this->core->root . DS . 'snippets' . DS . 'patterns';
    $snippet = $root . DS . $pattern . '.php';
    return tpl::load($snippet, $args);
  }

  protected function base($args) {
    $dir = $this->core->root . DS . 'snippets' . DS . 'patterns';
    return tpl::load($dir . DS . 'base.php', a::merge([
      'class'   => null,
      'url'     => null,
      'label'   => null,
      'icon'    => null,
      'mobile'  => 'icon',
      'content' => null,
      'title'   => null,
      'right'   => false
    ], $args));
  }

}
