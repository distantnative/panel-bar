<?php

require 'core.php';

class PanelBar extends PanelBarCore {

  public $elements = array(
      'panel',
      'add',
      'edit',
      'toggle',
      'languages',
      'logout',
      'user'
    );


  // Display functions
  public static function show($args = array()) {
    $self = new self($args);
    return $self->__output($args);
  }

  public static function hide($args = array()) {
    $args['hide'] = true;
    return self::show($args);
  }


  // Assets output functions
  public static function css() {
    $self = new self();
    return $self->__getCSS(c::get('panelbar.position', 'top'));
  }

  public static function js() {
    $self = new self();
    return $self->__getJS();
  }


  // Default elements
  public static function defaults() {
    $self = new self();
    return $self->elements;
  }

}
