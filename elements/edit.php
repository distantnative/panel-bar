<?php

namespace panelBar\Elements;

use panelBar\Build;

class Edit extends Base {

  public function edit() {
    // register assets
    $this->_iframe(__FUNCTION__);

    // return output
    return Build::link(array(
      'id'     => __FUNCTION__,
      'icon'   => 'pencil',
      'url'    => $this->page->url('edit'),
      'label'  => 'Edit',
      'title'  => 'Alt + E',
    ));
  }

}
