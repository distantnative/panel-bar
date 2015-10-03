<?php

require 'core/core.php';
use PanelBar\Core;

class PanelBar extends Core {

  public $defaults = array(
    'panel',
    'add',
    'edit',
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

  public static function css($css) {
    $self = new self();
    $self->assets->setHook('css', $css);
    return $self->assets->css();
  }

  public static function js($js) {
    $self = new self();
    $self->assets->setHook('js', $js);
    return $self->assets->js();
  }


  /**
   *  DEFAULT ELEMENTS
   */

  public static function defaults() {
    $self = new self();
    return $self->defaults;
  }

}
