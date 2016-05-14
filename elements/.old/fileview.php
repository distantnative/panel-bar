<?php

namespace panelBar\Elements;

class Fileview extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    $this->core->loadElement('images');
    $view = new Images($this->core);
    return $view->html(null);
  }

}
