<?php

namespace panelBar;

use A;

class Pattern {

  //====================================
  //   Magic call for pattern classes
  //====================================

  public static function __callStatic($name, $arguments) {
    // Call the pattern subclass
    $class  = 'panelBar\\Patterns\\' . $name;
    $result = call_user_func_array(array($class, 'html'), $arguments);

    // if already wrapped, return
    if($name === 'blank') return $result;

    // otherwise wrap in blank pattern
    return array(
      'element' => call_user_func_array(array('self', 'blank'), $result['element']),
      'assets'  => isset($result['assets']) ? $result['assets'] : null
    );

  }

}
