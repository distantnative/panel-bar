<?php

namespace Kirby\panelBar;

use C;
use Str;
use Tpl;

class Assets {

  public $css = [];
  public $js  = [];

  public function __construct($core) {
    $this->core = $core;

    $this->add('css', $this->link('css', 'panelbar.css'));
    $this->add('js',  $this->link('js',  'panelbar.js'));
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
    return $this->core->html->load('assets' . DS . $mode, [
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

}
