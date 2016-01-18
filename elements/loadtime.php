<?php

namespace panelBar\Elements;

use panelBar\Build;
use panelBar\Assets;

class Loadtime extends Base {

  public function html() {
    // register assets
    $this->assets->setHook('js', assets::load('js', 'elements/loadtime'));
    // return output
    return build::label(array(
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
