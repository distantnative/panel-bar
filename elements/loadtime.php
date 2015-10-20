<?php

namespace panelBar\Elements;

use panelBar\Tools;
use panelBar\Build;

class Loadtime extends Base {

  public function loadtime() {
    // register assets
    $this->assets->setHook('js', tools::load('js', 'elements/loadtime.min'));
    // return output
    return Build::label(array(
      'id'     => __FUNCTION__,
      'icon'   => 'clock-o',
      'label'  => $this->time(),
      'mobile' => 'label',
    ));
  }

  private function time() {
    return number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 2);
  }

}
