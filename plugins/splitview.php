<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Splitview extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    return pattern::link(array(
      'id'      => $this->getElementName(),
      'label'   => 'Splitview',
      'icon'    => 'columns',
      'url'     => $this->site->url() . '/splitview/?page_slug=' . urlencode($this->page->uri()),
      'compact' => true,
    ));
  }

}
