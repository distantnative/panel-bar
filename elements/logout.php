<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Logout extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    return pattern::link(array(
      'id'     => $this->getElementName(),
      'icon'   => 'power-off',
      'url'    => $this->panel->urls()->logout(),
      'label'  => 'Logout',
      'float'  => 'right',
    ));
  }

}
