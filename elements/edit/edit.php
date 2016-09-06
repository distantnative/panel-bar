<?php

namespace Kirby\panelBar;

use C;

class EditElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register overlay output and assets
    $this->withOverlay();
    
    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => 'Edit',
      'icon'  => 'pencil',
      'url'   => $this->page->url('edit'),
      'title' => c::get('plugin.panelBar.keys', true) ? 'Alt + M' : null,
    ]);
  }

}
