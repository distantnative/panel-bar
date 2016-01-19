<?php

namespace panelBar\Patterns;

class Label {

  public static function html($arguments) {
    return array(
      'element' => array(
        'panelBar-label',
        null,
        $arguments
      ),
    );
  }

}
