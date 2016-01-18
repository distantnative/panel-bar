<?php

namespace panelBar\Elements;

use panelBar\Build;

class Toggle extends Base {

  public function html() {
    // register assets
    $this->_iframe('toggle');

    // return output
    return build::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'label'  => $this->page->isVisible() ? 'Visible'   : 'Invisible',
      'url'    => $this->page->url('toggle'),
    ));
  }

}
