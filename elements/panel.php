<?php

namespace Kirby\panelBar\Elements;

class Panel extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register iFrame output and assets
    $this->withFrame();

    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => 'Panel',
      'icon'  => 'cogs',
      'url'   => $this->panel->urls()->index(),
    ]);
  }

}
