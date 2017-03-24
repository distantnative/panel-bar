<?php

namespace Kirby\panelBar;

use C;
use Tpl;

use Kirby\panelBar\Route;

class Element {

  public function __construct($core) {
    $this->core     = $core;
    $this->panel    = $core->panel;

    $this->site     = $this->panel->site();
    $this->page     = $this->panel->page($this->core->page->id());
  }


  //====================================
  //   Element characteristics
  //====================================

  public function dir() {
    return dirname(__DIR__) . DS . '..' . DS . 'elements' . DS . $this->name();
  }

  public function name() {
    $namespace = 'Kirby\panelBar\\';
    $name      = str_replace($namespace, '', get_class($this));
    $name      = str_ireplace('element', '', $name);
    return strtolower($name);
  }

  public function url($file) {
    return $this->dir() . DS . $file;
  }

  protected function asset($type, $asset) {
    $url  = 'elements/' . $this->name() . '/' . $asset;
    $link = $this->core->assets->link($type, $url);
    $this->core->assets->add($type, $link);
  }

  protected function tpl($file, $args = []) {
    return $this->load('templates' . DS . $file . '.php', $args);
  }

  protected function load($file, $args = []) {
    return tpl::load($this->url($file), $args);
  }

  protected function pattern($pattern, $args = []) {
    $class = 'Kirby\panelBar\\' . $pattern . 'Pattern';
    $class = new $class($this->core);
    return $class->render($args);
  }

  protected function route($route, $parameters= []) {
    return Route::url($this->name(), $route, $parameters);
  }

  //====================================
  //   Features
  //====================================
  public function component() {
    return new Components($this);
  }


}
