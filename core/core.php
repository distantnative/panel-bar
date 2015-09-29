<?php

namespace PanelBar;

require 'helpers.php';
require 'elements.php';
require 'controls.php';
require 'assets.php';

use A;
use C;

use PanelBar\Elements;
use PanelBar\Controls;
use PanelBar\Assets;

class Core extends Helpers {

  public $elements     = null;
  public $position     = null;
  public $visible      = true;

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


  // Placeholder for static methods
  public static function defaults() { }
  public static function show()     { }
  public static function hide()     { }
  public static function css()      { }
  public static function js()       { }


  // Creating the output for the panel bar
  protected function __output() {
    if ($user = site()->user() and $user->hasPanelAccess()) {

      $class   = 'panelbar ';
      $class  .= 'panelbar--'.$this->position.' ';
      if ($this->visible === false) $class .= 'panelbar--hidden ';

      $bar     = '<div class="'.$class.'" id="panelbar">';
      $bar    .= '<div class="panelbar-return__iframe"><iframe></iframe></div>';
      $bar    .= '<div class="panelbar__bar" id="panelbar_bar">';
      $bar    .= $this->__content();
      $bar    .= '<span class="panelbar-return__btn"><i class="fa fa-arrow-circle-left"></i> Return to page</span>';
      $bar    .= '</div>';
      $bar    .= Controls::output();

      if ($this->includeCSS) $bar .= Assets::css($this->hookCSS);
      if ($this->includeJS)  $bar .= Assets::js($this->hookJS);

      $bar    .= '</div>';

      return $bar;
    }
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

}
