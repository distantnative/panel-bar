<?php

namespace PanelBar;

use C;
use Tpl;

class Assets {

  public static function getCSS($position = null) {
    $style  = tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS . 'panelbar.min.css');
    return '<style>'.$style.'</style>';
  }

  public static function getJS() {
    $script  = 'siteURL="'.site()->url().'";';
    $script .= 'currentURI="'.page()->uri().'";';
    $script .= 'enhancedJS='.(c::get('panelbar.enhancedJS', false) ? 'true' : 'false').';';
    $script .= tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'js' . DS . 'panelbar.min.js');
    return '<script>'.$script.'</script>';
  }
}
