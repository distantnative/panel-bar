<?php

namespace panelBar;

use C;

class Output extends Hooks {

  public $before;
  public $elements;
  public $after;
  public $next;

  private $visible;
  private $position;


  public function __construct($visible) {
    $this->before   = array();
    $this->elements = array();
    $this->after    = array();
    $this->next     = array();

    $this->visible  = $visible;
    $this->position = c::get('panelbar.position', 'top');
  }


  public function get() {
    return tools::load('html', 'main', array(
      'class'    => 'panelBar panelBar--' . $this->position .
                    ($this->visible === false ? ' panelBar--hidden' : ''),
      'before'   => $this->getHooks('before'),
      'elements' => $this->getHooks('elements'),
      'after'    => $this->getHooks('after'),
      'next'     => $this->getHooks('next'),
    ));
  }

  public function login($url) {
    return tools::load('html', 'login', array(
      'style'  => tools::fontPaths(tools::load('css', 'components/login')),
      'script' => 'var PANEL_URL="' . $url . '";' . tools::load('js',  'components/login'),
    ));
  }

}
