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
      'label'  => 'Logout',
      'icon'   => 'power-off',
      'url'    => $this->panel->urls()->logout(),
      'float'  => 'right',
    ));
  }

}
