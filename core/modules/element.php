<?php

namespace Kirby\panelBar;

use C;
use Tpl;

use Kirby\panelBar\Route;

class Element {

  public function __construct($core) {
    $this->core     = $core;
    $this->panel    = $core->panel;

    $this->site     = site();
    $this->page     = $this->panel->page($this->core->page->id());
  }


  //====================================
  //   Element characteristics
  //====================================

  protected function dir() {
    return dirname(__DIR__) . DS . '..' . DS . 'elements' . DS . $this->name();
  }

  protected function name() {
    $namespace = 'Kirby\panelBar\\';
    $name      = str_replace($namespace, '', get_class($this));
    $name      = str_ireplace('element', '', $name);
    return strtolower($name);
  }

  protected function url($file) {
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

  protected function withCount($items) {
    $this->core->assets->add('css', [
      $this->core->assets->link('css', 'components' . DS . 'count.css'),
    ]);

    $dir = dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'patterns';
    return tpl::load($dir . DS . 'count.php', ['count' => count($items)]);
  }

  protected function withOverlay() {
    $path   = 'components' . DS . 'overlay';
    $assets = $this->core->assets;
    $html   = $this->core->html;

    $assets->add('js', [
      $assets->tag('js', 'siteURL="' . $this->site->url() . '";'),
      $assets->link('js', $path . '.js'),
      $assets->tag('js', 'panelBar.overlay.bind(".panelBar--' . $this->name() . ' a");'),
    ]);

    $assets->add('css', $assets->link('css', $path . '.css'));

    // register output
    $html->add('pre',      $html->load($path . DS . 'frame.php'));
    $html->add('elements', $html->load($path . DS . 'links.php'));
  }

}
