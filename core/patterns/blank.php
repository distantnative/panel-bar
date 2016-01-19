<?php

namespace panelBar\Patterns;

use A;
use panelBar\Tpl;

class Blank {

  public static function html($classes, $content, $arguments = array()) {

    // default varibles for the blank pattern template
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

    // override defaults with $arguments
    $vars          = a::merge($vars, $arguments);
    $vars['class'] = $classes . ' ' . self::extractClasses($arguments);

    return tpl::load('patterns/blank', $vars);
  }

  private static function extractClasses($arguments) {
    $classes  = isset($arguments['class']) ? $arguments['class']: '';
    $classes .= (isset($arguments['float']) and $arguments['float']) ? ' panelBar-element--right' : '';
   return $classes;
  }

}
