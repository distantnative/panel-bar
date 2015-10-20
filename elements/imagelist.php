<?php

namespace panelBar\Elements;

class Imagelist extends Base {

  public function imagelist() {
    $list = new Files($this->page, $this->output, $this->assets);
    return $list->files('image', __FUNCTION__);
  }

}
