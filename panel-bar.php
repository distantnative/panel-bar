<?php

require 'core/core.php';
use PanelBar\Core;

class PanelBar extends Core {

  // Display functions
  public static function show($args = array()) {
    $self = new self($args);
    return $self->__output();
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
