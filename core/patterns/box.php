<?php

namespace Kirby\panelBar\Patterns;

use A;
use Tpl;

class Box extends Pattern {

  public function render($args) {
    // register assets
    $this->asset('css', 'patterns' . DS . 'box.css');
    $this->asset('css', 'modules'  . DS . 'drop.css');

    // return output
    return $this->base(a::merge([
      'class'   => 'panelBar-box panelBar-mDropParent',
      'content' => tpl::load(dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'patterns' . DS . 'box.php', [
        'box' => $args['box'],
      ])], $args
    ));
  }

}
