<?php

namespace PanelBar;

require 'helpers.php';
require 'elements.php';
require 'controls.php';
require 'assets.php';

use A;
use C;
use Tpl;

use PanelBar\Elements;
use PanelBar\Controls;
use PanelBar\Assets;

class Core extends Helpers {

  public $elements     = null;
  public $position     = null;
  public $visible      = true;

  public $assets       = null;
  public $includeCSS   = true;
  public $includeJS    = true;
  public $hooksCSS     = null;
  public $hooksJS      = null;

  protected $protected = null;


  public function __construct($args = array()) {
    $args = a::merge(array(
      'elements'  => $this->__defaultElements($args),
      'css'       => true,
      'js'        => true,
      'css.hooks' => null,
      'js.hooks'  => null,
      'hide'      => false,
    ), $args);

    $this->elements   = $args['elements'];
    $this->position   = c::get('panelbar.position', 'top');
    $this->visible    = $args['hide'] !== true;

    $this->includeCSS = $args['css'];
    $this->includeJS  = $args['js'];
    $this->hooksCSS   = $args['css.hooks'];
    $this->hooksJS    = $args['js.hooks'];
    $this->assets     = new Assets(array(
      'css' => $this->hooksCSS,
      'js'  => $this->hooksJS,
    ));

    $this->protected = array_diff(get_class_methods('PanelBar\Core'), $this->elements);
  }


  // Creating the output for the panel bar
  protected function __output() {
    return tpl::load(realpath(__DIR__ . '/..') . DS . 'templates' . DS . 'main.php', array(
      'class'    => 'panelbar panelbar--' . $this->position .
                    ($this->visible === false ? ' panelbar--hidden' : ''),
      'elements' => $this->__elements(),
      'controls' => Controls::output(),
      'assets'   => ($this->includeCSS ? $this->assets->css() : '') .
                    ($this->includeJS ? $this->assets->js() : ''),
    ));
  }

  protected function __elements() {
    $output = '';
    foreach ($this->elements as $element) {
      // $element is custom function
      if(is_callable($element)) {
        $output .= call_user_func($element);
      }

      // $element is default function
      elseif($ref = new Elements() and
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


  // Selecting the right elements to show (specified vs. defaults)
  protected function __defaultElements($args) {
    return
      (isset($args['elements']) and is_array($args['elements'])) ?
      $args['elements'] :
      c::get('panelbar.elements', $this->defaults);
  }


  // Placeholder for static methods
  public static function defaults() { }
  public static function show()     { }
  public static function hide()     { }
  public static function css()      { }
  public static function js()       { }

}
