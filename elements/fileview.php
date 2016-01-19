<?php

namespace panelBar\Elements;

class Fileview extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    $view = new Images($this->page, $this->output, $this->assets);
    return $view->html(null);
  }

}
