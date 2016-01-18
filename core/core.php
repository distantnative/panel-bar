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

  public $panel;

  public function __construct($opt = array()) {
    $this->panel  = require_once(__DIR__ . '/lib/integrate.php');
    $this->panel  = panel();

    // Assets
    $this->css    = isset($opt['css']) ? $opt['css'] : true;
    $this->js     = isset($opt['js'])  ? $opt['js']  : true;
    $this->assets = new Assets(array(
      'css' => $this->css,
      'js'  => $this->js
    ));

    // Output
    $visible      = !(isset($opt['hide']) and $opt['hide'] === true);
    $this->output = new Output($visible);

    // Elements
    $this->elements = $this->selectElements($opt);
  }


  /**
   *  OUTPUT
   */

  protected function _output() {
    if($this->hasPermission()) {
      $this->hookControls();
      $this->hookElements();
      $this->hookAssets();
      return $this->output->get();

    } elseif($this->showLogin()) {
      $url = $this->panel->urls()->index();
      return $this->output->login($url);
    }
  }

  protected function selectElements($opt) {
    if(isset($opt['elements']) and is_array($opt['elements'])) {
      return $opt['elements'];
    } else {
      return c::get('panelbar.elements',$this->defaults);
    }
  }

  protected function hookElements() {
    foreach ($this->elements as $id => $element) {

      // $element is standard element
      if($class  = 'panelBar\\Elements\\'.$element and
         class_exists($class)) {
        $element = $this->getElementObj($class);

      // $element is plugin element
      } elseif($class = 'panelBar\\Plugins\\'.$element and
               class_exists($class)) {
        $element = $this->getElementObj($class);

      // $element is callable
      } elseif(is_callable($element)) {
        $element = $this->getElementCallable($element);

      // $element is string
      } elseif(is_string($element)) {
        $element = $this->getElementString($element, $id);
      }

      $this->hookElement($element);
    }
  }

  protected function hookElement($element) {
    // element has specified various hooks
    if(is_array($element)) {
      if(isset($element['assets'])) {
        $this->assets->setHooks($element['assets']);
      }
      if(isset($element['html'])) {    $this->output->setHooks($element['html']);
      }
      if(isset($element['element'])) {
        $this->output->setHook('elements', $element['element']);
      }

    // element is only a string
    } else {
      $this->output->setHook('elements', $element);
    }
  }

  protected function getElementObj($class) {
    $obj = new $class($this);
    return $obj->html();
  }

  protected function getElementCallable($callable) {
    return call_user_func_array($callable, array($this->output, $this->assets));
  }

  protected function getElementString($string, $id) {
    return build::_element(null, $string, array('id' => $id));
  }

  protected function hookControls() {
    $this->output->setHook('next', tpl::load('controls'));
  }

  protected function hookAssets() {
    foreach(array('css', 'js') as $type) {
      if($this->$type !== false) {
        $this->output->setHook('after', $this->assets->$type());
      }
    }
  }

  protected function hasPermission() {
    return $user = site()->user() and $user->hasPanelAccess();
  }

  protected function showLogin() {
    return c::get('panelbar.login', true);
  }


  /**
   *  PLACEHOLDERS for public static methods
   */

  public static function show()               { }
  public static function hide()               { }
  public static function css($args = array()) { }
  public static function js($args = array())  { }
  public static function defaults()           { }

}
