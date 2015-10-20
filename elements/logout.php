<?php

namespace panelBar\Elements;

use panelBar\Build;

class Logout extends Base {

  public function logout() {
    // return output
    return Build::link(array(
      'id'     => __FUNCTION__,
      'icon'   => 'power-off',
      'url'    => $this->panel->urls()->logout(),
      'label'  => 'Logout',
      'float'  => 'right',
    ));
  }

}
