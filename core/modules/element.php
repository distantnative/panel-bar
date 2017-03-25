<?php

namespace Kirby\panelBar;

use C;
use F;
use L;
use Tpl;

use Kirby\panelBar\Route;

class Element {

  public $name;
  public $root;

  public function __construct($core) {
    $this->core     = $core;
    $this->panel    = $core->panel;

    $this->site     = $this->panel->site();
    $this->page     = $this->panel->page($this->core->page);

    $this->translations();
  }


  //====================================
  //   Characteristics
  //====================================
  public function name() {
    if($this->name) return $this->name;

    $namespace = 'Kirby\panelBar\\';
    $name      = str_replace($namespace, '', get_class($this));
    $name      = str_ireplace('element', '', $name);
    return $this->name = strtolower($name);
  }

  public function dir() {
    return $this->root ?: $this->root = $this->core->root . DS . 'elements' . DS . $this->name();
  }

  public function url($file) {
    return $this->dir() . DS . $file;
  }

  //====================================
  //   Assets
  //====================================
  protected function asset($type, $asset) {
    $url  = 'elements/' . $this->name() . '/' . $asset;
    $link = $this->core->assets->link($type, $url);
    $this->core->assets->add($type, $link);
  }

  //====================================
  //   Templates & Patterns
  //====================================
  protected function tpl($file, $args = []) {
    return $this->load('templates' . DS . $file . '.php', $args);
  }

  protected function load($file, $args = []) {
    return tpl::load($this->url($file), $args);
  }

  protected function pattern($pattern, $args = []) {
    $class = 'Kirby\panelBar\\' . $pattern . 'Pattern';
    $class = new $class($this);
    return $class->render($args);
  }

  //====================================
  //   Components
  //====================================
  public function component() {
    return new Components($this);
  }

  //====================================
  //   Routes
  //====================================
  protected function route($route, $parameters= []) {
    return Route::url($this->name(), $route, $parameters);
  }

  //====================================
  //   Translations
  //====================================
  protected function translations() {
    $dir = $this->dir() . DS . 'translations';
    if(f::exists($dir)) {
      foreach(['en', $this->site->locale()] as $lang) {
        $file = $dir . DS . $lang . '.php';
        f::load($file);
      }
    }
  }

  protected function l($key) {
    return l::get('panelBar.element.' . $this->name() . '.' . $key);
  }

}
