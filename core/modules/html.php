<?php

namespace Kirby\panelBar;

use Tpl;

class Html {

  public $elements = [];
  public $pre      = [];
  public $post     = [];

  public function add($position, $html) {
    $this->{$position}[] = $html;
    $this->{$position}   = array_unique($this->{$position});
  }

  public function render($position) {
    return implode('', $this->{$position});
  }

  public function load($file) {
    return tpl::load(dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . $file);
  }

}