<?php

namespace Kirby\panelBar;

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
        'kirby'   => \Kirby::version(),
        'panel'   => \Panel::version(),
        'toolkit' => \Toolkit::version(),
      ])
    ]);
  }

}
