<?php

namespace PanelBar;

require_once 'toolkit.php';
require_once 'hooks.php';
require_once 'builders.php';
require_once 'elements.php';
require_once 'output.php';
require_once 'assets.php';

use A;
use C;

use PanelBar\PB;
use PanelBar\Elements;
use PanelBar\Output;
use PanelBar\Assets;

class Core extends Build {

  public $elements;
  public $position;

  public $output;
  public $assets;
  public $css = true;
  public $js  = true;


  public function __construct($args = array()) {
    // Elements
    $this->elements = (isset($args['elements']) and is_array($args['elements'])) ?
                      $args['elements'] : c::get('panelbar.elements', $this->defaults);

    // Output
    $visible      = !(isset($args['hide']) and $args['hide'] === true);
    $this->output = new Output($visible);

    // Assets
    $this->css    = isset($args['css']) ? $args['css'] : true;
    $this->js     = isset($args['js'])  ? $args['js']  : true;
    $this->assets = new Assets(array('css' => $this->css, 'js'  => $this->js));
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
    foreach ($this->elements as $element) {

      // $element is default function
      if($ref = new Elements($this->output, $this->assets) and
         is_callable(array($ref, $element)) and
         substr($element, 0, 1) !== '_') {
        $element = call_user_func(array($ref, $element));
      }

      if(is_array($element)) {
        $this->assets->setHooks($element['assets']);
        $this->output->setHooks($element['html']);
        $this->output->setHook('elements', $element['element']);
      } elseif(is_string($element)) {
        $this->output->setHook('elements', $element);
      }

    }
  }

  protected function _controls() {
    $this->output->setHook('after', pb::load('html', 'controls.php'));
  }

  protected function _assets() {
    if($this->css !== false) $this->output->setHook('after', $this->assets->css());
    if($this->js  !== false) $this->output->setHook('after', $this->assets->js());
  }


  /**
   *  PLACEHOLDERS for static methods
   */

  public static function defaults() { }
  public static function show()     { }
  public static function hide()     { }
  public static function css($css)  { }
  public static function js($js)    { }

}
