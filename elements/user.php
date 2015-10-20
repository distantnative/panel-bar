<?php

namespace panelBar\Elements;

use panelBar\Build;

class User extends Base {

  public function user() {
    // register assets
    $this->_iframe(__FUNCTION__);

    // return output
    return Build::link(array(
      'id'     => __FUNCTION__,
      'icon'   => 'user',
      'url'    => $this->site->user()->url('edit'),
      'label'  => $this->site->user(),
      'float'  => 'right',
    ));
  }

}
