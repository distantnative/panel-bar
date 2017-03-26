<?php

namespace Kirby\panelBar;

use A;

class LinkPattern extends Pattern {

  public static $classes = 'panelBar-link';

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'link.css');

    // return output
    return $this->base(a::merge([
      'class' => self::classes(),
    ], $args));
  }

}
