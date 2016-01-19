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

  //====================================
  //   Return combined output
  //====================================

  public function get() {
    return tpl::load('base', array(
      'class'    => 'panelBar' . $this->modifierClasses(),
      'before'   => $this->getHooks('before'),
      'elements' => $this->getHooks('elements'),
      'after'    => $this->getHooks('after'),
      'next'     => $this->getHooks('next'),
    ));
  }

  protected function modifierClasses() {
    $classes  = ' panelBar--' . $this->position;
    $classes .= $this->visible === false ? ' panelBar--hidden' : '';
    return $classes;
  }

  //====================================
  //   Login icon
  //====================================

  public function getLoginIcon($url) {
    $css = assets::fontPaths(assets::load('css', 'components/login'));
    $js  = 'var PANEL_URL="' . $url . '";';
    $js .= assets::load('js',  'components/login');

    return tpl::load('components/login', array(
      'style'  => $css,
      'script' => $js,
    ));
  }

}
