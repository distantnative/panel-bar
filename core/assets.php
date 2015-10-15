<?php

namespace PanelBar;

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
    return '<style>'.$this->fontPaths($this->getHooks('css')).'</style>';
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
        tools::load('css', 'panelbar.css'),
      ),
      'js'  => array(
        'var PanelBarKEYS=' . (c::get('panelbar.keys', true) ? 'true;' : 'false;'),
        tools::load('js', 'panelbar.min.js'),
      ),
    ));

    // JS: Responsive
    if(c::get('panelbar.responsive', true)) {
      $this->setHook('js', tools::load('js', 'components/responsive.min.js'));
    }

    // JS: State - localStorage
    if(c::get('panelbar.remember', true)) {
      $this->setHook('js', tools::load('js', 'components/localstorage.min.js'));
    }
  }



  /**
   *  FONTS
   */

  protected function fontPaths($css) {
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
