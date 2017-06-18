<?php

namespace Kirby\panelBar;

use A;
use C;
use F;
use Tpl;

class Core extends Translations {

  public static $version = '2.3.1';

  public    $root;
  protected $elements;

  public function __construct($args = []) {
    $this->config = new Config;
    $this->root   = __DIR__;
    $this->page   = page();
    $this->panel  = require('lib/panel/integrate.php');

    $this->visible  = !isset($args['hidden']) || $args['hidden'] === true;
    $this->position = c::get('panelBar.position', 'top');

    $this->translations();

    $this->html     = new Html($this);
    $this->assets   = new Assets($this);
    $this->elements = new Elements($this, $args);
  }

  //====================================
  //   Characteristics
  //====================================

  public function dir() {
    return $this->root;
  }

  //====================================
  //   Output hooks
  //====================================
  public function elements() {
    return $this->html->render('elements');
  }

  public function pre() {
    $this->html->add('pre', $this->assets->render('css'));
    return $this->html->render('pre');
  }

  public function post() {
    $this->html->add('post', $this->assets->render('js'));
    return $this->html->render('post');
  }

  //====================================
  //   Components
  //====================================
  public function controls() {
    return $this->html->load('components' . DS . 'controls');
  }

  public function login() {
    if(c::get('panelBar.login', false)) {
      return $this->html->load('components' . DS . 'login');
    }
  }

  //====================================
  //   Styling
  //====================================
  public function classes() {
    return implode(' ', a::merge(
      ['panelBar--' . $this->position],
      (!$this->visible ? ['panelBar--hidden'] : [])
    ));
  }
}
