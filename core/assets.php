<?php

namespace PanelBar;

use C;

use PanelBar\PB;

class Assets extends Hooks {

  public $css;
  public $js;


  public function __construct($external) {
    $this->css   = array();
    $this->js    = array();

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
        pb::load('css', 'panelbar.css'),
      ),
      'js'  => array(
        'var panelbarKEYS=' . (c::get('panelbar.keys', true) ? 'true;' : 'false;'),
        pb::load('js', 'panelbar.min.js'),
      ),
    ));

    // JS: Responsive
    if(c::get('panelbar.responsive', true)) {
      $this->setHook('js', pb::load('js', 'components' . DS . 'responsive.min.js'));
    }

    // JS: State - localStorage
    if(c::get('panelbar.remember', false)) {
      $this->setHook('js', pb::load('js', 'components' . DS . 'localstorage.min.js'));
    }
  }



  /**
   *  FONTS
   */

  protected function fontPaths($css) {
    $fonts = array(
      array('{{FA}}',        pb::font('fontawesome-webfont.woff?v=4.2', false)),
      array('{{SSP400}}',    pb::font('sourcesanspro-400.woff')),
      array('{{SSP600}}',    pb::font('sourcesanspro-600.woff')),
      array('{{SSPitalic}}', pb::font('sourcesanspro-400-italic.woff')),
    );
    foreach($fonts as $font) {
      $css = str_ireplace($font[0], $font[1], $css);
    }
    return $css;
  }

}
