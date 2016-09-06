<?php

namespace Kirby\panelBar;

use C;
use Str;
use Tpl;

class Assets {

  public $css = [];
  public $js  = [];

  public function __construct() {
    $this->defaults();
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
      $dir = dirname(__DIR__) . DS . '..' . DS . 'snippets' . DS . 'assets';
      return tpl::load($dir . DS . $type . '.php', [
        $type => implode('', $this->{$type})
      ]);
    }
  }


  //====================================
  //   Load asset
  //====================================

  public function load($type, $asset, $args = []) {
    $dir = dirname(__DIR__) . DS . '..' . DS . 'assets';
    return tpl::load($dir . DS . $type . DS . $asset, $args);
  }


  //====================================
  //   Default assets
  //====================================

  protected function defaults() {

    // Default CSS
    $css = $this->load('css', 'panelbar.css');
    $css = str::template($css, [
      'fontPath' => panel()->urls()->assets() . '/fonts'
    ]);
    $this->add('css', $css);

    // Default JS
    $this->add('js', $this->load('js', 'panelbar.js'));

    // Optional additional assets
    $this->components();
    $this->rtl();
  }

  protected function components() {
    $bundles = [
      'plugin.panelBar.keys'       => 'components' . DS . 'keybindings.js',
      'plugin.panelBar.remember'   => 'components' . DS . 'localstorage.js',
      'plugin.panelBar.responsive' => 'components' . DS . 'responsive.js',
    ];

    foreach ($bundles as $option => $asset) {
      if(c::get($option, true)) {
        $this->add('js', $this->load('js', $asset));
      }
    }
  }

  protected function rtl() {
    if($language = site()->language() and $language->direction() === 'rtl') {
      $this->add('css', $this->load('css', 'components' . DS . 'rtl.css'));
    }
  }

}
