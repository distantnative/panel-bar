<?php

namespace panelBar\Elements;

class Fileview extends \panelBar\Element {

  public function html() {
    $view = new Images($this->page, $this->output, $this->assets);
    return $view->images(null, 'fileview');
  }

}
