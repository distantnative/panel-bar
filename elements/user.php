<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class User extends \panelBar\Element {

  public function html() {
    // register assets
    $this->_iframe('user');

    // return output
    return pattern::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->user()->url('edit'),
      'label'  => $this->site->user(),
      'float'  => 'right',
    ));
  }

}
