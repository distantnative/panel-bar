<?php

namespace panelBar;

require_once(__DIR__ . '/../lib/tools.php');
require_once(__DIR__ . '/../lib/hooks.php');
require_once(__DIR__ . '/../lib/build.php');

require_once('elements.php');
require_once('output.php');
require_once('assets.php');

use C;

class Core extends Build {

  public $elements;
  public $standards;
  public $output;
  public $assets;
  public $css;
  public $js;


  public function __construct($opt = array()) {
    // Assets
    $this->css    = isset($opt['css']) ? $opt['css'] : true;
    $this->js     = isset($opt['js'])  ? $opt['js']  : true;
    $this->assets = new Assets(array('css' => $this->css, 'js'  => $this->js));

    // Output
    $visible      = !(isset($opt['hide']) and $opt['hide'] === true);
    $this->output = new Output($visible);

    // Elements
    $this->elements  = (isset($opt['elements']) and is_array($opt['elements'])) ?
                       $opt['elements'] : c::get('panelbar.elements',$this->defaults);
    $this->standards = new Elements($this->output, $this->assets);
  }


  /**
   *  OUTPUT
   */

  protected function _output() {
    $this->_elements();
    $this->_controls();
    $this->_assets();
    return $this->output->get();
  }

  // get all elements
  protected function _elements() {
    foreach ($this->elements as $id => $el) {

      // $element is default function
      if(is_callable(array($this->standards, $el)) and
         substr($el, 0, 1) !== '_') {
        $el = call_user_func(array($this->standards, $el));

      // $element is callable
      } elseif(is_callable($el)) {
        $el = call_user_func_array($el, array($this->output, $this->assets));

      // $element is string
      } elseif(is_string($el)) {
        $el = build::_element(null, $el, array('id' => $id));
      }

      if(is_array($el)) {
        if(isset($el['assets']))  $this->assets->setHooks($el['assets']);
        if(isset($el['html']))    $this->output->setHooks($el['html']);
        if(isset($el['element'])) $this->output->setHook('elements', $el['element']);
      } else {
        $this->output->setHook('elements', $el);
      }

    }
  }

  protected function _controls() {
    $this->output->setHook('after', tools::load('html', 'controls'));
  }

  protected function _assets() {
    if($this->css !== false) $this->output->setHook('after', $this->assets->css());
    if($this->js  !== false) $this->output->setHook('after', $this->assets->js());
  }


  /**
   *  PLACEHOLDERS for static methods
   */

  public static function show()               { }
  public static function hide()               { }
  public static function css($args = array()) { }
  public static function js($args = array())  { }
  public static function defaults()           { }

}
