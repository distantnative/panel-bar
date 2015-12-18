<?php

namespace panelBar;

use C;

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
      array('{FA.woff2}',  $base . 'fontawesome-webfont.woff2?v=4.4.0'),
      array('{FA.woff}',   $base . 'fontawesome-webfont.woff?v=4.4.0'),
      array('{{SSP400}}',    $base . 'sourcesanspro-400.woff'),
      array('{{SSP600}}',    $base . 'sourcesanspro-600.woff'),
      array('{{SSPitalic}}', $base . 'sourcesanspro-400-italic.woff'),
    );
    foreach($fonts as $font) {
      $css = str_ireplace($font[0], $font[1], $css);
    }
    return $css;
  }

}
