<?php

namespace PanelBar;

class Helpers {
  // public helper functions to create elements
  public static function label($args) {
    $class  = 'panelbar-label '.self::__class($args).' panelbar--'.$args['id'];
    $block  = '<div class="'.$class.'">';
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';
    $block .= '</div>';
    return $block;
  }

  public static function link($args) {
    $class  = 'panelbar-btn '.self::__class($args).' panelbar--'.$args['id'];
    $block  = '<div class="'.$class.'">';
    $link   = self::__icon($args) . self::__label($args);
    $block .= self::__link($link, $args);
    $block .= '</div>';
    return $block;
  }

  public static function dropdown($args) {
    $class  = 'panelbar-drop '.self::__class($args).' panelbar--'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // all items
    $block .= '<div class="panelbar-drop__list">';
    foreach($args['items'] as $item) {
      $block .= self::__link($item['label'], $item, 'panelbar-drop__item');
    }
    $block .= '</div>';

    $block .= '</div>';
    return $block;
  }

  public static function box($args) {
    $class  = 'panelbar-box '.self::__class($args).' panelbar--'.$args['id'];
    $block  = '<div class="'.$class.'">';

    // label
    $block .= '<span>';
    $block .= self::__icon($args);
    $block .= self::__label($args);
    $block .= '</span>';

    // box content
    $block .= '<div class="panelbar-box__content" '.self::__style($args).'>';
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

  protected static function __link($content, $args = array(), $class = null) {
    if (isset($args['url'])) {
      return '<a href="'.$args['url'].'" class="'.$class.'">'.$content.'</a>';
    } else if (!is_null($class)) {
      return '<span class="'.$class.'">'.$content.'</span>';
    } else {
      return $content;
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

  protected static function __class($args) {
    $class = '';
    if (isset($args['class'])) {
      $class .= $args['class'].' ';
    }
    $class .= self::__float($args);
    return $class;
  }

  protected static function __float($args) {
    return (isset($args['float']) and $args['float'] !== false) ? 'panelbar-element--right' : '';
  }
}
