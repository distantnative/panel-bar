<?php

namespace Kirby\panelBar;

use A;
use Tpl;

class BoxPattern extends Pattern {

  public static $classes = 'panelBar-box panelBar-mDropParent';

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'box.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    // return output
    return $this->base(a::merge([
      'content' => $this->tpl('box', [
        'box' => $this->element->component()->content($args['box']),
      ])
    ], $args));
  }

}
