<?php

namespace panelBar\Elements;

use panelBar\Build;

class Edit extends Base {

  public function html() {
    // register assets
    $this->_iframe('edit');

    // return output
    return Build::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->page->url('edit'),
      'label'  => 'Edit',
      'title'  => 'Alt + E',
    ));
  }

}
