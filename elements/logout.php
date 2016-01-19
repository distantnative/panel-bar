<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Logout extends \panelBar\Element {

  public function html() {
    // return output
    return pattern::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->panel->urls()->logout(),
      'label'  => 'Logout',
      'float'  => 'right',
    ));
  }

}
