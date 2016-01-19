<?php

namespace panelBar\Elements;

class Imagelist extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    $this->core->loadElement('files');
    $list = new Files($this->core);
    return $list->html('image');
  }

}
