<?php

namespace Kirby\panelBar;

use C;
use F;
use Tpl;

class Core {

  public static $version = '2.1.0';

  public    $root;
  protected $elements;

  public $position = 'top';
  public $visible  = true;

  public function __construct($args = []) {
    $this->root  = dirname(__DIR__);
    $this->page  = page();
    $this->panel = require('lib/panel/integrate.php');

    $this->visible  = !isset($args['hidden']) || $args['hidden'] === true;
    $this->position = c::get('panelBar.position', 'top');

    $this->translations();

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
    return $this->html->render('pre');
  }

  public function post() {
    $this->html->add('post', $this->assets->render('js'));
    return $this->html->render('post');
  }

  public function controls() {
    return tpl::load($this->root . DS .  'snippets' . DS . 'components' . DS . 'controls.php');
  }

  public function login() {
    if(c::get('panelBar.login', true)) {
      return tpl::load($this->root . DS .  'snippets' . DS . 'components' . DS . 'login.php');
    }
  }

  public function classes() {
    $classes = ['panelBar--' . $this->position];
    if(!$this->visible) $classes[] = 'panelBar--hidden';
    return implode(' ', $classes);
  }

  protected function translations() {
    $lang = site()->language();
    foreach(['en', ($lang ? $lang->code() : null)] as $translation) {
      $file = dirname(__DIR__) . DS . 'translations' . DS . $translation . '.php';
      f::load($file);
    }
  }
}
