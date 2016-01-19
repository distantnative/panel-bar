<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Toggle extends \panelBar\Element {

  public function html() {
    // register assets
    $this->_iframe('toggle');

    // return output
    return pattern::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'label'  => $this->page->isVisible() ? 'Visible'   : 'Invisible',
      'url'    => $this->page->url('toggle'),
    ));
  }

}
