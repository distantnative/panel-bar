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
      'css' => array(
        tools::load('css', 'panelbar'),
      ),
      'js'  => array(
        'var panelBarKEYS=' . (c::get('panelbar.keys', true) ? 'true;' : 'false;'),
        tools::load('js', 'panelbar'),
      ),
    ));

    // JS: Responsive
    if(c::get('panelbar.responsive', true)) {
      $this->setHook('js', tools::load('js', 'components/responsive'));
    }

    // JS: State - localStorage
    if(c::get('panelbar.remember', true)) {
      $this->setHook('js', tools::load('js', 'components/localstorage'));
    }
  }



  /**
   *  FONTS
   */

  private function fontPaths($css) {
    $base  = panel()->urls()->assets() . '/fonts/';
    $fonts = array(
      array('{{FA.eot}}',    $base . 'fontawesome-webfont.eot?v=4.4.0'),
      array('{{FA.iefix}}',  $base . 'fontawesome-webfont.eot?#iefix&v=4.4.0'),
      array('{{FA.woff2}}',  $base . 'fontawesome-webfont.woff2?v=4.4.0'),
      array('{{FA.woff}}',   $base . 'fontawesome-webfont.woff?v=4.4.0'),
      array('{{FA.ttf}}',    $base . 'fontawesome-webfont.ttf?v=4.4.0'),
      array('{{FA.svg}}',    $base . 'fontawesome-webfont.svg?v=4.4.0#fontawesomeregular'),
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
