<?php

namespace Kirby\panelBar;

use F;

class SystemElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register assets
    $this->asset('css', 'system.css');
    $this->asset('js',  'system.min.js');


    // return output
    return $this->pattern('box', [
      'id'    => $this->name(),
      'icon'  => 'info',
      'label' => 'System',
      'box'   => $this->tpl('list', [
        'kirby'    => \Kirby::version(),
        'panel'    => $this->version('panel'),
        'toolkit'  => \Toolkit::version(),
        'panelbar' => Core::$version
      ])
    ]);
  }

  protected function version($path) {
    $root = kirby()->roots()->index() . DS;
    return json_decode(f::read($root . $path . DS . 'package.json'))->version;
  }

}
