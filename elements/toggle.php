<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Toggle extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->withIframe();

    // return output
    return pattern::link(array(
      'id'     => $this->getElementName(),
      'label'  => $this->page->isVisible() ? 'Visible'   : 'Invisible',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->page->url('toggle'),
    ));
  }

}
