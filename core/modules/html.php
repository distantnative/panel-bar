<?php

namespace Kirby\panelBar;

use Tpl;

class Html {

  public $elements = [];
  public $pre      = [];
  public $post     = [];

  public function __construct($core) {
    $this->core = $core;
  }

  public function add($position, $html) {
    $this->{$position}[] = $html;
    $this->{$position}   = array_unique($this->{$position});
  }

  public function render($position) {
    return implode('', $this->{$position});
  }

  public function load($file, $args = []) {
    $file = $this->core->dir() . DS . 'snippets' . DS . $file . '.php';
    return tpl::load($file, $args);
  }

}
