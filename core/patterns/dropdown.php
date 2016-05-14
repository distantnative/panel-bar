<?php

namespace Kirby\Plugins\distantnative\panelBar\Patterns;

use A;
use Tpl;

class Dropdown extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'dropdown.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    // return output
    return $this->base(a::merge([
      'class'   => 'panelBar-dropdown panelBar-mDropParent',
      'content' => tpl::load(dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'patterns' . DS . 'dropdown.php', [
        'items' => $args['items'],
      ])
    ], $args));
  }

}
