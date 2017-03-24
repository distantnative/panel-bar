<?php

namespace Kirby\panelBar;

use C;
use Str;
use Tpl;

class Assets {

  public $css = [];
  public $js  = [];

  public function __construct() {
    $this->add('css', $this->link('css', 'panelbar.css'));
    $this->add('js',  $this->link('js',  'panelbar.js'));

    $this->rtl();
  }

  //====================================
  //   Add asset
  //====================================

  public function add($type, $asset) {
    if(is_array($asset)) {
      foreach ($asset as $a) {
        $this->add($type, $a);
      }
    } else {
      $this->{$type}[] = $asset;
      $this->{$type}   = array_unique($this->{$type});
    }
  }


  //====================================
  //   Render combined assets
  //====================================

  public function render($type) {
    if(!empty($this->{$type})) {
      return implode($this->{$type});
    }
  }


  //====================================
  //   Load asset
  //====================================

  protected function load($type, $asset, $mode) {
    $root = dirname(dirname(__DIR__)) . DS . 'snippets' . DS . 'assets' . DS;
    return tpl::load($root . $mode . '.php', [
      'type'   => $type,
      'asset'  => $asset
    ]);
  }

  public function link($type, $asset) {
    return $this->load($type, $asset, 'link');
  }

  public function tag($type, $asset) {
    return $this->load($type, $asset, 'tag');
  }


  //====================================
  //   Optionals
  //====================================

  protected function rtl() {
    if($language = site()->language() and $language->direction() === 'rtl') {
      $this->add('css', $this->link('css', 'components' . DS . 'rtl.css'));
    }
  }

}
