<?php

namespace PanelBar;

class Controls {

  public static function output() {
    $controls  = '<div class="panelbar__controls" id ="panelbar_control">';
    $controls .= self::flip();
    $controls .= self::toggle();
    $controls .= '</div>';
    return $controls;
  }

  protected static function flip() {
    $flip  = '<div class="panelbar__flip" id ="panelbar_flip">';
    $flip .= '<i class="fa fa-arrow-circle-up panelbar__flip--top"></i>';
    $flip .= '<i class="fa fa-arrow-circle-down panelbar__flip--bottom"></i>';
    $flip .= '</div>';
    return $flip;
  }

  protected static function toggle() {
    $switch  = '<div class="panelbar__switch" id ="panelbar_switch">';
    $switch .= '<i class="fa fa-times-circle panelbar__switch--visible"></i>';
    $switch .= '<i class="fa fa-plus-circle panelbar__switch--hidden"></i>';
    $switch .= '<i class="fa fa-circle panelbar__switch--bg"></i>';
    $switch .= '</div>';
    return $switch;
  }

}
