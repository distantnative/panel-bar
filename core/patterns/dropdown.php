<?php

namespace Kirby\panelBar;

use A;

class DropdownPattern extends Pattern {

  public static $classes = 'panelBar-dropdown panelBar-mDropParent';

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'dropdown.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    // return output
    return $this->base(a::merge([
      'content' => $this->tpl('dropdown', [
        'items' => $args['items'],
      ])
    ], $args));
  }

}
