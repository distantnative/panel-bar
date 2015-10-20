<?php

namespace panelBar;

require_once('bootstrap.php');

use C;

class Core extends Build {

  public $elements;
  public $output;
  public $assets;
  public $css;
  public $js;

  protected $page;
  protected $panel;

  public function __construct($opt = array()) {
    $this->page   = page();
    $this->panel  = require_once(__DIR__ . '/../lib/integrate.php');

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

      // $element is standard element
      $class = 'panelBar\Elements\\' . $el;
      if(class_exists($class)) {
        $class = new $class($this->page, $this->output, $this->assets);
        $el    = $class->$el();

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
