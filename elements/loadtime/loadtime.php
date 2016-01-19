<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Assets;

class Loadtime extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->assets->setHook('js', $this->js('loadtime'));
    // return output
    return pattern::label(array(
      'id'     => $this->getElementName(),
      'icon'   => 'clock-o',
      'label'  => $this->time(),
      'mobile' => 'label',
    ));
  }

  //====================================
  //   Helpers
  //====================================

  private function time() {
    return number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 2);
  }

}
