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

    // register key shortcut: alt + M
    $this->key(77, 'panelBar.dom.bar.querySelector(".panelBar--' . $this->name() . ' a").click();');

    // return pattern output
    return $this->pattern('link', [
      'id'    => $this->name(),
      'label' => $this->l('label'),
      'icon'  => 'pencil',
      'url'   => $this->page->url('edit'),
      'title' => $this->l('label') . (c::get('panelBar.keys', true) ? ' (Alt + M)' : null),
    ]);
  }

}
