<?php

namespace Kirby\distantnative\panelBar\Patterns;

use A;

class Link extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'link.css');

    // return output
    return $this->base(a::merge([
      'class' => 'panelBar-link',
    ], $args));
  }

}
