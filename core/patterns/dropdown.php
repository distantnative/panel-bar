<?php

namespace panelBar\Patterns;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Dropdown {

  public static function html($arguments) {
    $dropdown = tpl::load('patterns/dropdown', array('items' => $arguments['items']));

    return array(
      'element' => array('panelBar-drop panelBar-mDropParent', $dropdown, $arguments),
      'assets'  => array('css' => array(
        assets::load('css', 'build/drop'),
        assets::load('css', 'modules/drop'),
      )),
    );
  }

}
