<?php

namespace PanelBar;

require 'helpers.php';
require 'elements.php';

use A;
use C;
use Tpl;

use PanelBar\Elements;

class Core extends Helpers {

  public $site         = null;
  public $page         = null;

  public $elements     = null;
  public $position     = null;
  public $visible      = true;

  public $includeCSS   = true;
  public $includeJS    = true;

  protected $protected = null;


  public function __construct($args = array()) {
    $args = $this->__defaultParameters($args);

    $this->elements   = c::get('panelbar.elements', $args['elements']);
    $this->position   = c::get('panelbar.position', 'top');
    $this->visible    = $args['hide'] !== true;
    $this->includeCSS = $args['css'];
    $this->includeJS  = $args['js'];

    $this->site      = site();
    $this->page      = page();
    $this->protected = array_diff(get_class_methods('PanelBar\Core'), $this->elements);
    print_r($this->protected);
  }


  // defaults for $args parameter
  protected function __defaultParameters($args) {
    return a::merge(array(
      'elements' => get_class_methods('PanelBar\Elements'),
      'css'      => true,
      'js'       => true,
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
  protected function __output($args = array()) {
    if ($user = site()->user() and $user->hasPanelAccess()) {

      $classes = 'panelbar '.$this->position.' '.($this->visible === false ? 'hidden' : '');
      $bar     = '<div class="'.$classes.'" id="panelbar">'.$this->__content().'</div>';
      $bar    .= $this->__controlBtn();

      if ($this->includeCSS) $bar .= $this->__getCSS();
      if ($this->includeJS)  $bar .= $this->__getJS();

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


  // Output for control elements
  protected function __controlBtn() {
    $controls  = '<div class="panelbar__controls" id ="panelbar_control">';
    $controls .= $this->__flipBtn();
    $controls .= $this->__switchBtn();
    $controls .= '</div>';
    return $controls;
  }

  protected function __switchBtn() {
    $switch  = '<div class="panelbar__switch" id ="panelbar_switch">';
    $switch .= '<i class="fa fa-times-circle panelbar__switch--visible"></i>';
    $switch .= '<i class="fa fa-plus-circle panelbar__switch--hidden"></i>';
    $switch .= '<i class="fa fa-circle panelbar__switch--bg"></i>';
    $switch .= '</div>';
    return $switch;
  }

  protected function __flipBtn() {
    $flip  = '<div class="panelbar__flip" id ="panelbar_flip">';
    $flip .= '<i class="fa fa-arrow-circle-up panelbar__flip--top"></i>';
    $flip .= '<i class="fa fa-arrow-circle-down panelbar__flip--bottom"></i>';
    $flip .= '</div>';
    return $flip;
  }


  // Output the assets
  protected function __getCSS($position = null) {
    $style  = tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'css' . DS . 'panelbar.min.css');
    return '<style>'.$style.'</style>';
  }

  protected function __getJS() {
    $script  = 'siteURL="'.$this->site->url().'";';
    $script .= 'currentURI="'.$this->page->uri().'";';
    $script .= 'enhancedJS='.(c::get('panelbar.enhancedJS', false) ? 'true' : 'false').';';
    $script .= tpl::load(realpath(__DIR__ . '/..') . DS . 'assets' . DS . 'js' . DS . 'panelbar.min.js');
    return '<script>'.$script.'</script>';
  }

}
