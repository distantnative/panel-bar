<?php

namespace panelBar;

class Tpl {

  public static function load($file, $array = array()) {
    $root = realpath(__DIR__ . '/../..');
    $path = $root . DS . 'templates' . DS . $file . '.php';
    return \tpl::load($path, $array);
  }
  
}
