<?php

namespace panelBar\Elements;

use panelBar\Build;

class Panel extends Base {

  public function panel() {
    // register assets
    $this->_iframe(__FUNCTION__);

    // return output
    return Build::link(array(
      'id'      => __FUNCTION__,
      'icon'    => 'cogs',
      'url'     => $this->panel->urls()->index(),
      'label'   => '<span class="in-compact">Go to </span>Panel',
      'compact' => true,
    ));
  }

}
