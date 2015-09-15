<?php

namespace PanelBar;

class Helpers {
  // Element Helpers

  // public helper functions to create elements
  public static function label($args) {
    $class  = 'panelbar__element panelbar__element--label '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$classes.'">';
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';
    $block .= '</div>';
    return $block;
  }

  public static function link($args) {
    $class  = 'panelbar__element panelbar__element--btn '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';
    $block .= '<a href="'.$args['url'].'">';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</a>';
    $block .= '</div>';
    return $block;
  }

  public static function dropdown($args) {
    $class  = 'panelbar__element panelbar__element--drop '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // all items
    $block .= '<div class="panelbar__dropitems">';
    foreach($args['items'] as $item) {
      $block .= '<a href="'.$item['url'].'" class="panelbar__dropitem">'.$item['label'].'</a>';
    }
    $block .= '</div>';

    $block .= '</div>';
    return $block;
  }

  public static function box($args) {
    $class  = 'panelbar__element panelbar__element--box '.self::__float($args).' pbel-'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // box content
    $block .= '<div class="panelbar__element--boxcontent" '.self::__style($args).'>';
    $block .= $args['content'];
    $block .= '</div>';

    $block .= '</div>';
    return $block;
  }


  // Helper methods for element helpers
  protected static function __icon($args) {
    if (isset($args['icon'])) {
      $icon  = '<i class="fa fa-'.$args['icon'];
      if (isset($args['mobile']) and $args['mobile'] == 'label') $icon .= ' not-mobile';
      $icon .= '"></i>';
      return $icon;
    }
  }

  protected static function __label($args) {
    if (isset($args['label'])) {
      $label  = '<span';
      if (!isset($args['mobile']) or $args['mobile'] == 'icon') $label .= ' class="not-mobile"';
      $label .= '">'.$args['label'].'</span>';
      return $label;
    }
  }

  protected static function __style($args) {
    if (isset($args['style'])) {
      $style  = ' style="';
      foreach ($args['style'] as $key => $value) {
        $style .= $key.': '.$value.';';
      }
      $style .= '"';
      return $style;
    }
  }

  protected static function __float($args) {
    return (isset($args['float']) and $args['float'] !== false) ? 'panelbar__element--right' : '';
  }
}
