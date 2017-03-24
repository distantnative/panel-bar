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
      'box'   => [
        'style'   => 'keyvalue',
        'content' => [
          'Kirby'    => ['label' => \Kirby::version(),        'url' => null],
          'Panel'    => ['label' => $this->version('panel'),  'url' => null],
          'Toolkit'  => ['label' => \Toolkit::version(),      'url' => null],
          'panelBar' => ['label' => Core::$version,           'url' => null],
        ]
      ]
    ]);
  }

  protected function version($path) {
    $root = kirby()->roots()->index() . DS;
    return json_decode(f::read($root . $path . DS . 'package.json'))->version;
  }

}
