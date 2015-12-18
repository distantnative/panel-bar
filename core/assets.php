<?php

namespace panelBar;

use C;
use Str;

class Assets extends Hooks {

  public $css = array();
  public $js  = array();

  public function __construct($external) {
    $this->defaults();
    $this->setHooks($external);
  }


  /**
   *  DISPLAY
   */

  public function css() {
    if($language = site()->language() and $language->direction() === 'rtl') {
      $this->assets->setHook('css', tools::load('css', 'components/rtl'));
    }
    return '<style>'.$this->fontPaths($this->getHooks('css')).'</style>';
  }

  public function js() {
    return '<script>'.$this->getHooks('js').'</script>';
  }



  /**
   *  DEFAULTS
   */

  private function defaults() {
    $this->setHooks(array(
      'css' => array(tools::load('css', 'panelbar')),
      'js'  => array(
        tools::load('js',  'util/classes'),
        tools::load('js',  'panelbar')
      ),
    ));

    $this->bundles();
  }

  private function bundles() {
    $bundles = array(
      'panelbar.responsive' => array('js', 'components/responsive'),
      'panelbar.keys'       => array('js', 'components/keybindings'),
      'panelbar.remember'   => array('js', 'components/localstorage'),
    );

    foreach ($bundles as $option => $asset) {
      if(c::get($option, true)) {
        $this->setHook($asset[0], tools::load($asset[0], $asset[1]));
      }
    }
  }


  /**
   *  FONTS
   */

  private function fontPaths($css) {
    $base  = panel()->urls()->assets() . '/fonts/';
    $fonts = array(
      'FA.woff2'        => $base . 'fontawesome-webfont.woff2?v=4.4.0',
      'FA.woff'         => $base . 'fontawesome-webfont.woff?v=4.4.0',
      'SSP400.woff2'    => $base . 'sourcesanspro-400.woff2',
      'SSP400.woff'     => $base . 'sourcesanspro-400.woff',
      'SSP600.woff2'    => $base . 'sourcesanspro-600.woff2',
      'SSP600.woff'     => $base . 'sourcesanspro-600.woff',
      'SSPitalic.woff2' => $base . 'sourcesanspro-400-italic.woff2',
      'SSPitalic.woff'  => $base . 'sourcesanspro-400-italic.woff',
    );

    return str::template($css, $fonts);
  }

}
