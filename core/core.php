<?php

namespace PanelBar;

require 'hooks.php';
require 'helpers.php';
require 'elements.php';
require 'output.php';
require 'assets.php';

use A;
use C;
use Tpl;

use PanelBar\Elements;
use PanelBar\Output;
use PanelBar\Assets;

class Core extends Helpers {

  public $elements;
  public $position;

  public $output;
  public $assets;
  public $css = true;
  public $js  = true;

  protected $protected;


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

    $this->protected = array_diff(get_class_methods('PanelBar\Core'), $this->elements);
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
      // $element is custom function
      if(is_callable($element)) {
        $element = call_user_func_array($element, $this->output, $this->assets);
      }

      // $element is default function
      elseif($ref = new Elements($this->output, $this->assets) and
             is_callable(array($ref, $element)) and
             !in_array($element, $this->protected)) {
        $element = call_user_func(array($ref, $element));
      }

      if(is_string($element)) {
        $this->output->setHook('elements', $element);
      }

    }
  }

  protected function _controls() {
    $html = tpl::load($this->output->templates . 'controls.php');
    $this->output->setHook('after', $html);
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
