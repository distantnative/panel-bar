<?php

namespace Kirby\panelBar;

class LogoutElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'icon'  => 'power-off',
      'url'   => $this->panel->urls()->logout(),
      'right' => true
    ]);
  }

}
