<?php

namespace panelBar\Elements;

use panelBar\Build;

class Logout extends Base {

  public function html() {
    // return output
    return build::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->panel->urls()->logout(),
      'label'  => 'Logout',
      'float'  => 'right',
    ));
  }

}
