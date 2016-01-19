<?php

namespace panelBar;

use A;

class Pattern {

  public static function __callStatic($name, $arguments) {
    $class  = 'panelBar\\Patterns\\' . $name;
    $result = call_user_func_array(array($class, 'html'), $arguments);

    return array(
      'element' => call_user_func_array(array('self', 'element'), $result['element']),
      'assets'  => isset($result['assets']) ? $result['assets'] : null
    );
  }

  public static function element($classes, $content, $arguments = array()) {
    $vars = array(
      'class'   => null,
      'id'      => null,
      'title'   => null,
      'icon'    => false,
      'label'   => false,
      'mobile'  => 'icon',
      'compact' => false,
      'url'     => false,
      'content' => $content
    );

    $vars          = a::merge($vars, $arguments);
    $vars['class'] = self::classes($classes, $arguments);

    return tpl::load('build/base', $vars);
  }


  private static function classes($classes, $arguments) {
     return ' ' . (isset($arguments['class']) ? $arguments['class']: null) . ' ' . ((isset($arguments['float']) and $arguments['float']) ? 'panelBar-element--right' : null);
  }
}
