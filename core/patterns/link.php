<?php

namespace Kirby\panelBar;

use A;

class LinkPattern extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'link.css');

    // return output
    return $this->base(a::merge([
      'class' => isset($args['url']) ? 'panelBar-link' : 'panelBar-label',
    ], $args));
  }

}
