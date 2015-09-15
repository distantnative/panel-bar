<?php

namespace PanelBar;

use C;
use Tpl;

class Assets {

  public static function css($hook = null) {
    $style  = tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS . 'panelbar.min.css');
    $script .= self::hook($hook);
    return '<style>'.$style.'</style>';
  }

  public static function js($hook = null) {
    $script  = 'siteURL="'.site()->url().'";';
    $script .= 'currentURI="'.page()->uri().'";';
    $script .= 'enhancedJS='.(c::get('panelbar.enhancedJS', false) ? 'true' : 'false').';';
    $script .= tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'js' . DS . 'panelbar.min.js');
    $script .= self::hook($hook);
    return '<script>'.$script.'</script>';
  }

  protected static function hook($hook)  {
    if (is_string($hook)) {
      return $hook;
    } elseif (is_callable($hook)) {
      return call_user_func($hook);
    } else {
      return null;
    }
  }
}
