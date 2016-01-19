<?php

namespace panelBar\Patterns;

use panelBar\Assets;

class Link {

  public static function html($arguments) {
    return array(
      'element' => array(
        'panelBar-btn',
        null,
        $arguments
      ),
      'assets'  => array('css' => assets::load('css', 'patterns/btn')),
    );
  }

}
