<?php

namespace Kirby\panelBar;

use A;

class LinkPattern extends Pattern {

  public static $classes = 'panelBar-link';

  public function render($args) {
    return $this->base($args);
  }

}
