<?php

namespace panelBar\Patterns;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Box {

  public static function html($arguments) {
    $box = tpl::load('patterns/box', array(
      'box' => $arguments['box'],
    ));

    return array(
      'element' => array('panelBar-box panelBar-mDropParent', $box, $arguments),
      'assets'  => array('css' => array(
        assets::load('css', 'patterns/box'),
        assets::load('css', 'modules/drop'),
      )),
    );

  }

}
