<?php

namespace panelBar\Elements;

use panelBar\Build;

class Panel extends Base {

  public function html() {
    // register assets
    $this->_iframe('panel');

    // return output
    return build::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => $this->panel->urls()->index(),
      'label'   => '<span class="in-compact">Go to </span>Panel',
      'compact' => true,
    ));
  }

}
