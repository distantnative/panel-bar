<?php

namespace panelBar\Patterns;

use panelBar\Pattern;
use panelBar\Assets;

class Label {

  public static function html($arguments) {
    return array(
      'element' => array('panelBar-label', null, $arguments),
    );
  }

}
