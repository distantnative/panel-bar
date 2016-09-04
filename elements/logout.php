<?php

namespace Kirby\distantnative\panelBar\Elements;

class Logout extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => 'Logout',
      'icon'  => 'power-off',
      'url'   => $this->panel->urls()->logout(),
      'right' => true
    ]);
  }

}
