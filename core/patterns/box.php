<?php

namespace panelBar\Patterns;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Box {

  public static function html($arguments) {
    $box = tpl::load('build/box', array(
      'content' => $arguments['content'],
    ));

    return array(
      'element' => array('panelBar-box panelBar-mDropParent', $box, $arguments),
      'assets'  => array('css' => array(
        assets::load('css', 'build/box'),
        assets::load('css', 'modules/drop'),
      )),
    );

  }

}
