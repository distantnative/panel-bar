<?php

namespace Kirby\panelBar;

class PanelElement extends Element {

  //====================================
  //   Output
  //====================================
  public function render() {
    // register overlay output and assets
    $this->component()->overlay();

    // register key shortcut: alt + P
    $this->keybinding(80, 'location.href = panelBar.dom.bar.querySelector(".panelBar--' . $this . ' a").href;');

    // return pattern output
    return $this->pattern('link', [
      'label' => 'Panel',
      'icon'  => 'cogs',
      'url'   => $this->panel->urls()->index(),
    ]);
  }
}
