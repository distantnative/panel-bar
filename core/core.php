<?php

namespace Kirby\panelBar;

use C;
use F;
use Tpl;

class Core {

  protected $elements;

  public $position = 'top';
  public $visible  = true;

  public function __construct($args = []) {
    $this->page  = page();
    $this->panel = require('lib/panel/integrate.php');

    $this->visible  = !isset($args['hidden']) || $args['hidden'] === true;
    $this->position = c::get('plugin.panelBar.position', 'top');

    $this->html     = new Html;
    $this->assets   = new Assets;
    $this->elements = new Elements($this, $args);
  }


  //====================================
  //   Output
  //====================================

  public function elements() {
    return $this->html->render('elements');
  }

  public function pre() {
    $this->html->add('pre', $this->assets->render('css'));
    $this->html->add('post', $this->assets->render('js'));
    return $this->html->render('pre');
  }

  public function post() {
    return $this->html->render('post');
  }

  public function controls() {
    return tpl::load(dirname(__DIR__) . DS .  'snippets' . DS . 'components' . DS . 'controls.php');
  }

  public function classes() {
    $classes = ['panelBar--' . $this->position];
    if(!$this->visible) $classes[] = 'panelBar--hidden';
    return implode(' ', $classes);
  }


  //====================================
  //   Use checks
  //====================================

  public function isShown() {
    return $user = site()->user() and $user->hasPanelAccess();
  }


}
