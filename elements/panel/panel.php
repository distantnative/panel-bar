<?php

namespace Kirby\panelBar;

class PanelElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register overlay output and assets
    $this->component()->overlay();

    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => 'Panel',
      'icon'  => 'cogs',
      'url'   => $this->panel->urls()->index(),
    ]);
  }

}
