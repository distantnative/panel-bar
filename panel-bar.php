<?php
require_once 'core/core.php';

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


  /**
   *  DISPLAY
   */

  public static function show($args = array()) {
    if ($user = site()->user() and $user->hasPanelAccess()) {
      $self = new self($args);
      return $self->_output();
    }
  }

  public static function hide($args = array()) {
    $args['hide'] = true;
    return self::show($args);
  }


  /**
   *  ASSETS OUTPUT
   */

  public static function css($args = array()) {
    return self::assets('css', $args);
  }

  public static function js($args = array()) {
    return self::assets('js', $args);
  }

  protected static function assets($type, $args = array()) {
    $self = new self($args);
    $self->_elements();
    return $self->assets->{$type}();
  }


  /**
   *  DEFAULT ELEMENTS
   */

  public static function defaults($customs = array()) {
    $self = new self();
    return array_merge($self->defaults, $customs);
  }

}
