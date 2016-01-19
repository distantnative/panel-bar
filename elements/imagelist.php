<?php

namespace panelBar\Elements;

class Imagelist extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    $list = new Files($this->page, $this->output, $this->assets);
    return $list->html('image');
  }

}
