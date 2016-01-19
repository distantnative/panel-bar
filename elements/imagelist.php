<?php

namespace panelBar\Elements;

class Imagelist extends \panelBar\Element {

  public function html() {
    $list = new Files($this->page, $this->output, $this->assets);
    return $list->files('image', 'imagelist');
  }

}
