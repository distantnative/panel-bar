<?php
require_once('core/core.php');

use panelBar\Core;

class panelBar extends Core {

  public $defaults = array(
    'panel',
    'add',
    'edit',
    'toggle',
    'files',
    'logout',
    'user'
  );

  //====================================
  //   Display
  //====================================

  public static function show($args = array()) {
    if (get('panelBar') !== '0') {
      $self = new self($args);
      return $self->getOutput();
    }
  }

  public static function hide($args = array()) {
    $args['hide'] = true;
    return self::show($args);
  }

  //====================================
  //   Assets output
  //====================================

  public static function css($args = array()) {
    return self::assets('css', $args);
  }

  public static function js($args = array()) {
    return self::assets('js', $args);
  }

  protected static function assets($type, $args = array()) {
    $self = new self($args);
    $self->hookElements();
    return $self->assets->{$type}();
  }

  //====================================
  //   Default elements
  //====================================

  public static function defaults($customs = array()) {
    $self = new self();
    return array_merge($self->defaults, $customs);
  }

}
