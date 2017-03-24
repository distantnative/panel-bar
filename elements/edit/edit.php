<?php

namespace Kirby\panelBar;

use C;

class EditElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register overlay output and assets
    $this->component()->overlay();

    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => $this->l('label'),
      'icon'  => 'pencil',
      'url'   => $this->page->url('edit'),
      'title' => c::get('panelBar.keys', true) ? 'Alt + M' : null,
    ]);
  }

}
