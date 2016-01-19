<?php

namespace panelBar\Elements;

use C;
use panelBar\Pattern;

class Edit extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->withIframe();

    // return output
    return pattern::link(array(
      'id'     => $this->getElementName(),
      'icon'   => 'pencil',
      'url'    => $this->page->url('edit'),
      'label'  => 'Edit',
      'title'  => c::get('panelbar.keys', true) ? 'Alt + M' : null,
    ));
  }

}
