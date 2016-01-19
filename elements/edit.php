<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Edit extends \panelBar\Element {

  public function html() {
    // register assets
    $this->_iframe('edit');

    // return output
    return pattern::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->page->url('edit'),
      'label'  => 'Edit',
      'title'  => 'Alt + E',
    ));
  }

}
