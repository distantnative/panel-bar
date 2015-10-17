<?php

namespace panelBar;

use Tpl;

class Tools {

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
      'css'       => DS . 'assets'    . DS . 'css' . DS . $append . '.css',
      'js'        => DS . 'assets'    . DS . 'js'  . DS . $append . '.js',
      'html'      => DS . 'templates' . DS .              $append . '.php',
    );
    return realpath(__DIR__ . '/..') . $paths[$type];
  }

  public static function font($append) {
    return kirby()->urls()->index() . '/panel/assets/fonts/' . $append;
  }


  /**
   *  PANEL 'API'
   */

  public static function url($action, $obj = null) {
    if(is_null($obj)) {
      $url = $action;

    // Panel version < 2.2.0
    } elseif(!self::version('2.2.0')) {
      if(is_a($obj, 'File')) {
        if($action == 'index') {
          $url = '#/files/' . $action . '/' . $obj->page()->id() . '/';
        } else {
          $url = '#/files/' . $action . '/' . $obj->page()->id() . '/' . urlencode($obj->filename());
        }
      } else if(is_a($obj, 'Page')) {
        $url = '#/pages/' . $action . '/' . $obj->id();
      } else if(is_a($obj, 'User')) {
        $url = '#/users/' . $action . '/' . $obj->username();
      }

    // Panel version >= 2.2.0
    } else {
      if($action == 'show') $action = 'edit';

      if(is_a($obj, 'File')) {
        if($action == 'index') {
          $url = 'pages/' . $obj->page()->id() . '/files';
        } else {
          $url = 'pages/' . $obj->page()->id() . '/file/' . urlencode($obj->filename()) . '/' . $action;
        }
      } else if(is_a($obj, 'Page')) {
        $url = 'pages/' . $obj->id() . '/' . $action;
      } else if(is_a($obj, 'User')) {
        $url = 'users/' . $obj->username() . '/' . $action;
      }
    }

    if(!isset($url)) $url = '';

    return site()->url() . '/panel/' . $url;
  }


  public static function version($version) {
    switch($version) {
      case '2.2.0':
        return !file_exists('panel/app/panel.php') and
               file_exists('panel/app/src/panel.php');
        break;
      default:
        return false;
        break;
    }
  }

}
