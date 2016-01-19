<?php

namespace panelBar\Patterns;

use panelBar\Tpl;
use panelBar\Assets;

class Dropdown {

  public static function html($arguments) {
    $dropdown = tpl::load('patterns/dropdown', array(
      'items' => $arguments['items']
    ));

    return array(
      'element' => array(
        'panelBar-dropdown panelBar-mDropParent',
        $dropdown,
        $arguments
      ),
      'assets'  => array('css' => array(
        assets::load('css', 'patterns/dropdown'),
        assets::load('css', 'modules/drop'),
      )),
    );
  }

}
