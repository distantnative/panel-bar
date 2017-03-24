<?php

namespace Kirby\panelBar;

use Tpl;

class Components {

  public function __construct($element) {
    $this->element = $element;
    $this->core    = $element->core;
  }


  public function count($items) {
    $this->core->assets->add('css', [
      $this->core->assets->link('css', 'components' . DS . 'count.css'),
    ]);

    $dir = dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'components';
    return tpl::load($dir . DS . 'count.php', ['count' => count($items)]);
  }

  public function overlay() {
    $path   = 'components' . DS . 'overlay';
    $assets = $this->core->assets;
    $html   = $this->core->html;

    $assets->add('js', [
      $assets->tag('js', 'siteURL="' . $this->element->site->url() . '";'),
      $assets->link('js', $path . '.js'),
      $assets->tag('js', 'panelBar.overlay.bind(".panelBar--' . $this->element->name() . ' a");'),
    ]);

    $assets->add('css', $assets->link('css', $path . '.css'));

    // register output
    $html->add('pre',      $html->load($path . DS . 'frame.php'));
    $html->add('elements', $html->load($path . DS . 'links.php'));
  }
}
