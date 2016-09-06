<?php

namespace Kirby\panelBar;

use C;
use Tpl;

class Element {

  public function __construct($core) {
    $this->core     = $core;

    $this->panel    = $this->core->panel;
    $this->site     = $this->panel->site();
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
    $this->core->assets->add($type, $this->load('assets' . DS . $type . DS . $asset));
  }

  protected function load($file, $args = []) {
    return tpl::load($this->url($file), $args);
  }

  protected function tpl($file, $args) {
    return $this->load('templates' . DS . $file . '.php', $args);
  }

  protected function pattern($pattern, $args = []) {
    $class = 'Kirby\panelBar\Patterns\\' . $pattern;
    $class = new $class($this->core);
    return $class->render($args);
  }



  //====================================
  //   Features
  //====================================

  protected function withCount($items) {
    $this->core->assets->add('css', [
      $this->core->assets->load('css', 'components' . DS . 'count.css'),
    ]);

    $dir = dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'patterns';
    return tpl::load($dir . DS . 'count.php', ['count' => count($items)]);
  }

  protected function withOverlay() {
    $this->core->assets->add('js', [
      'siteURL="' . $this->site->url() . '";',
      $this->core->assets->load('js', 'components' . DS . 'overlay.js'),
      'panelBar.overlay.bind(".panelBar--' . $this->name() . ' a");'
    ]);

    $this->core->assets->add('css', [
      $this->core->assets->load('css', 'components' . DS . 'overlay.css'),
    ]);

    // register output
    $this->core->html->add('pre', $this->core->html->load('components' . DS . 'overlay' . DS . 'frame.php'));
    $this->core->html->add('elements', $this->core->html->load('components' . DS . 'overlay' . DS . 'links.php'));
  }

}
