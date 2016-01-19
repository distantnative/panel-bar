<?php

namespace panelBar\Patterns;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Dropdown {

  public static function html($arguments) {
    $drop = tpl::load('build/drop', array('items' => $arguments['items']));

    return array(
      'element' => array('panelBar-drop panelBar-mDropParent', $drop, $arguments),
      'assets'  => array('css' => array(
        assets::load('css', 'build/drop'),
        assets::load('css', 'modules/drop'),
      )),
    );
  }

}
