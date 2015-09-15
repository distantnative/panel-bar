<?php

namespace PanelBar;

class Controls {

  public static function output() {
    $controls  = '<div class="panelbar-controls" id ="panelbar_controls">';
    $controls .= self::flip();
    $controls .= self::toggle();
    $controls .= '</div>';
    return $controls;
  }

  protected static function flip() {
    $flip  = '<div class="panelbar-controls__flip" id ="panelbar_flip">';
    $flip .= '<i class="fa fa-arrow-circle-up panelbar-controls__flip--top"></i>';
    $flip .= '<i class="fa fa-arrow-circle-down panelbar-controls__flip--bottom"></i>';
    $flip .= '</div>';
    return $flip;
  }

  protected static function toggle() {
    $switch  = '<div class="panelbar-controls__switch" id ="panelbar_switch">';
    $switch .= '<i class="fa fa-times-circle panelbar-controls__switch--visible"></i>';
    $switch .= '<i class="fa fa-plus-circle panelbar-controls__switch--hidden"></i>';
    $switch .= '<i class="fa fa-circle panelbar-controls__switch--bg"></i>';
    $switch .= '</div>';
    return $switch;
  }

}
