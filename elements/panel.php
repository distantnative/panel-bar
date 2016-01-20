<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Panel extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->withIframe();

    // return output
    return pattern::link(array(
      'id'      => $this->getElementName(),
      'label'   => '<span class="in-compact">Go to </span>Panel',
      'icon'    => 'cogs',
      'url'     => $this->panel->urls()->index(),
      'compact' => true,
    ));
  }

}
