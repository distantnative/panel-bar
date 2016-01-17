<?php

namespace panelBar\Elements;

use panelBar\Tools;
use panelBar\Build;

class Loadtime extends Base {

  public function html() {
    // register assets
    $this->assets->setHook('js', tools::load('js', 'elements/loadtime'));
    // return output
    return Build::label(array(
      'id'     => 'loadtime',
      'icon'   => 'clock-o',
      'label'  => $this->time(),
      'mobile' => 'label',
    ));
  }

  private function time() {
    return number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 2);
  }

}
