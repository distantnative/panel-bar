<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class User extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->withIframe();

    // return output
    return pattern::link(array(
      'id'     => $this->getElementName(),
      'icon'   => 'user',
      'url'    => $this->site->user()->url('edit'),
      'label'  => $this->site->user(),
      'float'  => 'right',
    ));
  }

}
