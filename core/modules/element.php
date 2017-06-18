<?php

namespace Kirby\panelBar;

use C;
use F;
use L;
use Tpl;

use Kirby\panelBar\Route;

class Element extends Translations {

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
  public function __toString() {
    if($this->name) return $this->name;

    $namespace = 'Kirby\panelBar\\';
    $name      = str_replace($namespace, '', get_class($this));
    $name      = str_ireplace('element', '', $name);
    return $this->name = strtolower($name);
  }

  public function dir() {
    if($this->root) {
      return $this->root;
    } else {
      return $this->root = dirname($this->core->dir()) . DS . 'elements' . DS . $this;
    }
  }

  public function path($file) {
    return $this->dir() . DS . $file;
  }

  //====================================
  //   Assets
  //====================================
  protected function asset($type, $asset) {
    $url  = 'elements/' . $this . '/' . $asset;
    $this->core->assets->add($type, $this->core->assets->link($type, $url));
  }

  protected function keybinding($key, $js) {
    $js = 'panelBar.keys.bindings[' . $key . '] = function() { ' . $js . ' };';
    $this->core->assets->add('js', $this->core->assets->tag('js', $js));
  }

  //====================================
  //   Templates & Patterns
  //====================================
  protected function tpl($file, $args = []) {
    return $this->load('templates' . DS . $file . '.php', $args);
  }

  protected function load($file, $args = []) {
    return tpl::load($this->path($file), $args);
  }

  protected function pattern($pattern, $args = []) {
    $class = 'Kirby\panelBar\\' . $pattern . 'Pattern';
    $class = new $class($this);

    if(isset($args['class'])) {
      $args['class'] = $class::classes($args['class']);
    }

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
    return Route::url($this, $route, $parameters);
  }

  //====================================
  //   Translations
  //====================================
  public function l($key, $data = []) {
    return parent::l(['element', $this, $key], $data);
  }

}
