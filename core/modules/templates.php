<?php

namespace panelBar;

class Tpl {

  //====================================
  //   Load template file
  //====================================

  public static function load($file, $array = array()) {
    $root = realpath(__DIR__ . '/../..');
    $path = $root . DS . 'templates' . DS . $file . '.php';
    return \tpl::load($path, $array);
  }

}
