<?php

namespace panelBar\Elements;

use panelBar\Build;

class Loadtime extends Base {

  public function loadtime() {
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
