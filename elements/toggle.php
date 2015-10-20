<?php

namespace panelBar\Elements;

use panelBar\Build;

class Toggle extends Base {

  public function toggle() {
    // register assets
    $this->_iframe(__FUNCTION__);

    // return output
    return Build::link(array(
      'id'     => __FUNCTION__,
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'label'  => $this->page->isVisible() ? 'Visible'   : 'Invisible',
      'url'    => $this->page->url('toggle'),
    ));
  }

}
