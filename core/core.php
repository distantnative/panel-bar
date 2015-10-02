<?php

namespace PanelBar;

require 'helpers.php';
require 'elements.php';
require 'assets.php';

use A;
use C;
use Tpl;

use PanelBar\Elements;
use PanelBar\Assets;

class Core extends Helpers {

  public $elements     = null;
  public $position     = null;
  public $visible      = true;

  public $assets       = null;
  public $css          = true;
  public $js           = true;

  protected $protected = null;


  public function __construct($args = array()) {
    $this->elements   = $this->__defaultElements($args);
    $this->position   = c::get('panelbar.position', 'top');
    $this->visible    = !isset($args['hide']) or $args['hide'] !== true;

    // Assets
    $this->css    = isset($args['css']) ? $args['css'] : true;
    $this->js     = isset($args['js'])  ? $args['js']  : true;
    $this->assets = new Assets(array(
      'css' => $this->css,
      'js'  => $this->js,
    ));

    $this->protected = array_diff(get_class_methods('PanelBar\Core'), $this->elements);
  }



  /**
   *  OUTPUT
   */

  // main template
  protected function __output() {
    return tpl::load(realpath(__DIR__ . '/..') . DS . 'templates' . DS . 'main.php', array(
      'class'    => 'panelbar panelbar--' . $this->position .
                    ($this->visible === false ? ' panelbar--hidden' : ''),
      'elements' => $this->__elements(),
      'controls' => $this->__controls(),
      'assets'   => ($this->css !== false ? $this->assets->css() : '') .
                    ($this->js  !== false ? $this->assets->js()  : ''),
    ));
  }

  // get all elements
  protected function __elements() {
    $output = '';
    foreach ($this->elements as $element) {
      // $element is custom function
      if(is_callable($element)) {
        $output .= call_user_func_array($element, $this->assets);
      }

      // $element is default function
      elseif($ref = new Elements($this->assets) and
             is_callable(array($ref, $element)) and
             !in_array($element, $this->protected)) {
        $output .= call_user_func(array($ref, $element));
      }

      // $element is a string
      elseif(is_string($element)) {
        $output .= $element;
      }
    }

    return $output;
  }

  protected function __controls() {
    return tpl::load(realpath(__DIR__ . '/..') . DS . 'templates' . DS . 'controls.php');
  }



  /**
   *  DEFAULTS
   */

  protected function __defaultElements($args) {
    return
      (isset($args['elements']) and is_array($args['elements'])) ?
      $args['elements'] :
      c::get('panelbar.elements', $this->defaults);
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
