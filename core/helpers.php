<?php

namespace PanelBar;

class Helpers {
  // public helper functions to create elements
  public static function label($args) {
    return self::__element('', 'panelbar-label', $args);
  }

  public static function link($args) {
    return self::__element('', 'panelbar-btn', $args);
  }

  public static function dropdown($args) {
    // all items
    $block  = '<div class="panelbar-drop__list">';
    foreach($args['items'] as $item) {
      $block .= self::__link($item['label'], $item, 'panelbar-drop__item');
    }
    $block .= '</div>';

    return self::__element($block, 'panelbar-drop', $args);
  }

  public static function fileviewer($args) {
    // grid
    $class = 'panelbar-fileviewer__grid';
    $class = $class.' '.$class.'--'.$args['count'];
    $block = '<div class="'.$class.'" '.self::__style($args).'>';
    foreach ($args['items'] as $item) {
      $content  = '<div class="panelbar-fileviewer__preview">';

      if ($item['type'] == 'image') {
        $content .= '<div class="panelbar-fileviewer__image"
                          style="background-image:url('.$item['image'].');"></div>';
      }

      $content .= '<em '.r($item['type'] == 'image', 'style="display:none;"').'>';
      $content .= $item['extension'];
      $content .= '</em>';
      $content .= '<span class="panelbar-fileviewer__label">'.$item['label'].'</span>';
      $content .= '</div>';

      $class  = 'panelbar-fileviewer__item';
      $block .= self::__link($content, $item, $class.' '.$class.'--'.$item['type']);
    }

    if($args['more'] !== false) {
      $block .= self::__link('all '.$args['label'], array('url' => $args['more']), 'panelbar-fileviewer__more');
    }
    $block .= '</div>';

    return self::__element($block, 'panelbar-fileviewer', $args);

  }

  public static function box($args) {
    // box content
    $block  = '<div class="panelbar-box__content" '.self::__style($args).'>';
    $block .= $args['content'];
    $block .= '</div>';
    return self::__element($block, 'panelbar-box', $args);
  }


  // Helper methods for element helpers
  protected static function __element($block, $class, $args) {
    return pb::load('html', 'elements/element.php', array(
      'id'      => $args['id'],
      'class'   => $class . ' ' . self::__class($args),
      'content' => self::__link(self::__icon($args).self::__label($args), $args) . $block,
    ));
  }

  protected static function __icon($args) {
    if (isset($args['icon'])) {
      $icon  = '<i class="fa fa-'.$args['icon'];
      $icon .= r(isset($args['mobile']) and $args['mobile'] == 'label', ' not-mobile');
      $icon .= '"></i>';
      return $icon;
    }
  }

  protected static function __label($args) {
    if (isset($args['label'])) {
      $label  = '<span class="';
      $label .= r(!isset($args['mobile']) or $args['mobile'] == 'icon', 'not-mobile');
      $label .= '">'.$args['label'].'</span>';
      return $label;
    }
  }

  protected static function __link($content, $args = array(), $class = null) {
    if (isset($args['url'])) {
      return '<a href="'.$args['url'].'" class="'.$class.'">'.$content.'</a>';
    } else {
      return '<span class="'.$class.'">'.$content.'</span>';
    }
  }

  protected static function __style($args) {
    if (isset($args['style'])) {
      foreach ($args['style'] as $key => $value) {
        $style .= $key.': '.$value.';';
      }
      return ' style="' . $style . '"';
    }
  }

  protected static function __class($args) {
    if (isset($args['class'])) {
      return $args['class'] . ' '. self::__float($args);
    } else {
      return self::__float($args);
    }
  }

  protected static function __float($args) {
    if (isset($args['float']) and $args['float']) {
      return 'panelbar-element--right';
    }
  }
}
