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
  public $hookCSS      = null;
  public $hookJS      = null;

  protected $protected = null;


  public function __construct($args = array()) {
    $args = $this->__defaultParameters($args);

    $this->elements   = $args['elements'];
    $this->position   = c::get('panelbar.position', 'top');
    $this->visible    = $args['hide'] !== true;

    $this->assets     = new Assets();
    $this->includeCSS = $args['css'];
    $this->includeJS  = $args['js'];
    $this->hookCSS    = $args['css.hook'];
    $this->hookJS     = $args['js.hook'];

    $this->protected = array_diff(get_class_methods('PanelBar\Core'), $this->elements);
  }


  // defaults for $args parameter
  protected function __defaultParameters($args) {
    if (isset($args['elements']) and is_array($args['elements'])) {
      $elements = $args['elements'];
    } else {
      $elements = c::get('panelbar.elements', $this->defaults);
    }

    return a::merge(array(
      'elements' => $elements,
      'css'      => true,
      'js'       => true,
      'css.hook' => null,
      'js.hook'  => null,
      'hide'     => false,
    ), $args);
  }


  // Creating the output for the panel bar
  protected function __output() {
    return tpl::load(realpath(__DIR__ . '/..') . DS . 'templates' . DS . 'main.php', array(
      'class'    => 'panelbar panelbar--' . $this->position .
                    ($this->visible === false ? ' panelbar--hidden' : ''),
      'elements' => $this->__content(),
      'controls' => Controls::output(),
      'assets'   => ($this->includeCSS ? $this->assets->css() : '') .
                    ($this->includeJS ? $this->assets->js() : ''),
    ));
  }

  protected function __content() {
    $content = '';
    foreach ($this->elements as $element) {
      // $element is custom function
      if (is_callable($element)) {
        $content .= call_user_func($element);

      // $element is default function
      } elseif ($instance = new Elements() and is_callable(array($instance, $element)) and !in_array($element, $this->protected)) {
        $content .= call_user_func(array($instance, $element));

      // $element is a string
      } elseif (is_string($element)) {
        $content .= $element;
      }
    }

    return $content;
  }


  // Placeholder for static methods
  public static function defaults() { }
  public static function show()     { }
  public static function hide()     { }
  public static function css()      { }
  public static function js()       { }

}
