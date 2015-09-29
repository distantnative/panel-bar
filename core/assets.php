<?php

namespace PanelBar;

use C;
use Tpl;

class Assets {

  public static function css($hook = null) {
    $path   = realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS;
    $style  = tpl::load($path . 'panelbar.min.css');
    $style .= self::hook($hook);
    return '<style>'.self::paths($style).'</style>';
  }

  public static function js($hook = null) {
    $path    = realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'js' . DS;
    $script  = tpl::load($path . 'panelbar.min.js');

    if (c::get('panelbar.rembember', false)) {
      $script .= tpl::load($path . 'localstorage.min.js');
    }

    $script .= tpl::load($path . 'elements' . DS . 'iframe.min.js');
    $script .= self::hook($hook);

    return '<script>'.$script.'</script>';
  }

  protected static function paths($code){
    $base = str_repeat('../', substr_count(str_ireplace(kirby()->roots()->index(),'',__DIR__), '/'));
    $fonts = $base . 'panel/assets/fonts/';

    // Fonts
    $code = str_ireplace('{{FA}}', $fonts.'fontawesome-webfont.woff?v=4.2.0', $code);
    $code = str_ireplace('{{SSP400}}', $fonts.'sourcesanspro-400.woff', $code);
    $code = str_ireplace('{{SSP600}}', $fonts.'sourcesanspro-600.woff', $code);
    $code = str_ireplace('{{SSPitalic}}', $fonts.'sourcesanspro-400-italic.woff', $code);
    return $code;
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
