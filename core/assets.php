<?php

namespace PanelBar;

use C;
use Tpl;

class Assets extends Hooks {

  public $css;
  public $js;
  public $paths;


  public function __construct($external) {
    $this->paths = $this->setPaths();
    $this->css   = array();
    $this->js    = array();

    $this->defaults();
    $this->setHooks($external);
  }


  /**
   *  DISPLAY
   */

  public function css() {
    return '<style>'.$this->setFonts($this->getHooks('css')).'</style>';
  }

  public function js() {
    return '<script>'.$this->getHooks('js').'</script>';
  }



  /**
   *  DEFAULTS
   */

  protected function defaults() {
    $this->setHooks(array(
      'css' => array(
        tpl::load($this->paths['css'] . 'panelbar.css'),
      ),
      'js'  => array(
        tpl::load($this->paths['js'] . 'panelbar.min.js'),
      ),
    ));

    // JS: State - localStorage
    if(c::get('panelbar.rembember', false)) {
      $this->setHook('js', tpl::load($this->paths['js'] . 'localstorage.min.js'));
    }
  }



  /**
   *  PATHS
   */

  protected function setPaths() {
    $base = str_ireplace(kirby()->roots()->index(), '', __DIR__);
    $base = substr_count($base, '/');
    $base = str_repeat('../', $base);

    return array(
      'base'  => $base,
      'fonts' => $base . 'panel/assets/fonts/',
      'css'   => realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS,
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
      $css = str_ireplace($font[0], $font[1], $css);
    }
    return $css;
  }

}
