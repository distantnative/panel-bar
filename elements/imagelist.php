<?php

namespace panelBar\Elements;

class Imagelist extends Base {

  public function html() {
    $list = new Files($this->page, $this->output, $this->assets);
    return $list->files('image', 'imagelist');
  }
  
}
