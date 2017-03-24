<?php

namespace Kirby\panelBar;

use A;

class DropdownPattern extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'dropdown.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    // return output
    return $this->base(a::merge([
      'class'   => 'panelBar-dropdown panelBar-mDropParent',
      'content' => $this->tpl('dropdown', [
        'items' => $args['items'],
      ])
    ], $args));
  }

}
