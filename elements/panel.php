<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Panel extends \panelBar\Element {

  public function html() {
    // register assets
    $this->_iframe('panel');

    // return output
    return pattern::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => $this->panel->urls()->index(),
      'label'   => '<span class="in-compact">Go to </span>Panel',
      'compact' => true,
    ));
  }

}
