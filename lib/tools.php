<?php

namespace panelBar;

use Tpl;

class Tools {

  public static function load($type, $file, $array = array()) {
    return tpl::load(self::path($type, $file), $array);
  }

  public static function path($type, $append) {
    $paths = array(
      'css'       => DS . 'assets'    . DS . 'css' . DS . $append . '.css',
      'js'        => DS . 'assets'    . DS . 'js'  . DS . $append . '.js',
      'html'      => DS . 'templates' . DS .              $append . '.php',
    );
    return realpath(__DIR__ . '/..') . $paths[$type];
  }
}
