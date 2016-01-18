<?php

namespace panelBar\Elements;

use panelBar\Build;

class User extends Base {

  public function html() {
    // register assets
    $this->_iframe('user');

    // return output
    return build::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->user()->url('edit'),
      'label'  => $this->site->user(),
      'float'  => 'right',
    ));
  }

}
