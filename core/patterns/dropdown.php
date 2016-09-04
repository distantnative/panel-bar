<?php

namespace Kirby\panelBar\Patterns;

use A;
use Tpl;

class Dropdown extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'dropdown.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    $dir  = dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'patterns';
    $dropdown = tpl::load($dir . DS . 'dropdown.php', [
      'items' => $args['items'],
    ]);

    // return output
    return $this->base(a::merge([
      'class'   => 'panelBar-dropdown panelBar-mDropParent',
      'content' => $dropdown
    ], $args));
  }

}
