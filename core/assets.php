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
        tools::load('js', 'panelbar.min'),
      ),
    ));

    // JS: Responsive
    if(c::get('panelbar.responsive', true)) {
      $this->setHook('js', tools::load('js', 'components/responsive.min'));
    }

    // JS: State - localStorage
    if(c::get('panelbar.remember', true)) {
      $this->setHook('js', tools::load('js', 'components/localstorage.min'));
    }
  }



  /**
   *  FONTS
   */

  private function fontPaths($css) {
    $fonts = array(
      array('{{FA}}',        tools::font('fontawesome-webfont.woff?v=4.2', false)),
      array('{{SSP400}}',    tools::font('sourcesanspro-400.woff')),
      array('{{SSP600}}',    tools::font('sourcesanspro-600.woff')),
      array('{{SSPitalic}}', tools::font('sourcesanspro-400-italic.woff')),
    );
    foreach($fonts as $font) {
      $css = str_ireplace($font[0], $font[1], $css);
    }
    return $css;
  }

}
