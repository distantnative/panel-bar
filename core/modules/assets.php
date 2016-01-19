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

  //====================================
  //   Return combined assets
  //====================================

  public function css() {
    return '<style>'.self::fontPaths($this->getHooks('css')).'</style>';
  }

  public function js() {
    return '<script>'.$this->getHooks('js').'</script>';
  }

  //====================================
  //   Loading assets
  //====================================

  public static function load($type, $file, $array = array()) {
    $root  = realpath(__DIR__ . '/../..');
    $paths = array(
      'css'       => 'assets' . DS . 'css' . DS . $file . '.css',
      'js'        => 'assets' . DS . 'js'  . DS . 'dist' . DS . $file . '.min.js',
    );
    return \tpl::load($root . DS . $paths[$type], $array);
  }

  public static function fontPaths($css) {
    return str::template($css, array(
      'fontPath' => panel()->urls()->assets() . '/fonts'
    ));
  }

  //====================================
  //   Default assets
  //====================================

  private function defaults() {
    $this->setHooks(array(
      'css' => array(self::load('css', 'panelbar')),
      'js'  => array(
        self::load('js',  'tools/classes'),
        self::load('js',  'panelbar')
      ),
    ));

    $this->bundles();
    $this->rtl();
  }

  private function bundles() {
    $bundles = array(
      'panelbar.responsive' => array('js', 'components/responsive'),
      'panelbar.keys'       => array('js', 'components/keybindings'),
      'panelbar.remember'   => array('js', 'components/localstorage'),
    );

    foreach ($bundles as $option => $asset) {
      if(c::get($option, true)) {
        $this->setHook($asset[0], self::load($asset[0], $asset[1]));
      }
    }
  }

  private function rtl() {
    if($language = site()->language() and $language->direction() === 'rtl') {
      $this->assets->setHook('css', self::load('css', 'components/rtl'));
    }
  }

}
