<?php

namespace PanelBar;

use A;
use C;
use Tpl;

class Assets {

  public $css = array();
  public $js  = array();

  protected $paths = array();


  public function __construct() {
    $this->paths = $this->setPaths();

    if (c::get('panelbar.rembember', false)) {
      $this->setHook('js', tpl::load($this->paths['js'] . 'localstorage.min.js'));
    }
    $this->setHook('js', tpl::load($this->paths['js'] . 'elements' . DS . 'iframe.min.js'));
  }

  public function css() {
    $css  = tpl::load($this->paths['css'] . 'panelbar.min.css');
    $css  = $this->setFonts($css);
    $css .= $this->getHooks('css');
    return '<style>'.$css.'</style>';
  }

  public function js() {
    $js  = tpl::load($this->paths['js'] . 'panelbar.min.js');
    $js .= $this->getHooks('js');
    return '<script>'.$js.'</script>';
  }


  public function setHook($type, $hook) {
    if(!is_array($hook)) $hook = array($hook);
    $this->{$type} = a::merge($this->{$type}, $hook);
  }

  protected function getHooks($type) {
    $return = '';
    foreach($this->{$type} as $hook) {
      if(is_string($hook)) {
        $return .= $hook;
      } elseif(is_callable($hook)) {
        $return .= call_user_func($hook);
      }
    }
    return $return;
  }


  protected function setPaths() {
    $base = str_ireplace(kirby()->roots()->index(), '', __DIR__);
    $base = substr_count($base, '/');
    $base = str_repeat('../', $base);
    return array(
      'base'  => $base,
      'css'   => realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS,
      'fonts' => $base . 'panel/assets/fonts/',
      'js'    => realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'js' . DS,
    );
  }

  protected function setFonts($css) {
    $fonts = array(
      array('{{FA}}',        $this->paths['fonts'] . 'fontawesome-webfont.woff?v=4.2.0'),
      array('{{SSP400}}',    $this->paths['fonts'] . 'sourcesanspro-400.woff'),
      array('{{SSP600}}',    $this->paths['fonts'] . 'sourcesanspro-600.woff'),
      array('{{SSPitalic}}', $this->paths['fonts'] . 'sourcesanspro-400-italic.woff'),
    );
    foreach($fonts as $font) {
      $css = $this->placeholder($font[0], $font[1], $css);
    }
    return $css;
  }

  protected function placeholder($placeholder, $replacement, $string) {
    return str_ireplace($placeholder, $replacement, $string);
  }

}
