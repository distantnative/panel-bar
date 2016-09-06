<?php

namespace Kirby\panelBar;


class ToggleElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register overlay output and assets
    $this->withOverlay();
    
    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label'  => $this->page->isVisible() ? 'Visible'   : 'Invisible',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->page->url('toggle'),
    ]);
  }

}
