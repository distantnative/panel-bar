<?php

namespace Kirby\panelBar;

class LogoutElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // return pattern output
    return $this->pattern('link', [
      'icon'  => 'power-off',
      'url'   => $this->panel->urls()->logout(),
      'title' => $this->l('title')
    ]);
  }

}
