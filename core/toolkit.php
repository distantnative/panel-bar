<?php

namespace PanelBar;

use Tpl;

class PB {

  /**
   *  LOAD
   */

  public static function load($type, $file, $array = array()) {
    return tpl::load(self::path($type, $file), $array);
  }


  /**
   *  PATHS
   */

  public static function path($type, $append) {
    $paths = array(
      'css'       => DS . 'assets' . DS . 'css' . DS,
      'js'        => DS . 'assets' . DS . 'js' . DS,
      'html'      => DS . 'templates' . DS,
    );
    return realpath(__DIR__ . '/..') . $paths[$type] . $append;
  }

  public static function font($append) {
    $base = str_ireplace(kirby()->roots()->index(), '', __DIR__);
    $base = substr_count($base, '/');
    $base = str_repeat('../', $base);
    return $base . 'panel' . DS . 'assets' . DS . 'fonts' . DS . $append;
  }


  /**
   *  PANEL 'API'
   */

  public static function purl($old, $new = null) {
    return self::version('2.2.0') ? (is_null($new) ? $old : $new) : $old;
  }

  public static function version($version) {
    $kirby = kirby();
    return version_compare($kirby::$version, $version, '>=');
  }

}
