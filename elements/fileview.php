<?php

namespace panelBar\Elements;

class Fileview extends Base {

  public function fileview() {
    $view = new Images($this->page, $this->output, $this->assets);
    return $view->images(null, __FUNCTION__);
  }

}
