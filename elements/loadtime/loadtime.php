<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Assets;

class Loadtime extends \panelBar\Element {

  public function html() {
    // register assets
    $this->assets->setHook('js', assets::load('js', 'elements/loadtime'));
    // return output
    return pattern::label(array(
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
