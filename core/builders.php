<?php

namespace PanelBar;

class Build {

  /**
   *  PUBLIC CONSTRUCTORS
   */

  public static function label($args) {
    return self::_element('panelbar-label', '', $args);
  }

  public static function link($args) {
    return self::_element('panelbar-btn', '', $args);
  }

  public static function dropdown($args) {
    $drop = pb::load('html', 'elements/drop.php' , array('items' =>$args['items']));
    return self::_element('panelbar-drop', $drop, $args);
  }

  public static function fileviewer($args) {
    $grid = pb::load('html', 'elements/fileviewer.php', array(
      'items'   => $args['items'],
      'count'   => $args['count'],
      'all'     => array(
        'label' => $args['label'],
        'url'   => $args['all'],
      ),
      'style'   => self::_style($args),
    ));
    return self::_element('panelbar-fileviewer', $grid, $args);

  }

  public static function box($args) {
    $box = pb::load('html', 'elements/box.php', array(
      'style'   => self::_style($args),
      'content' => $args['content'],
    ));
    return self::_element('panelbar-box', $box, $args);
  }


  /**
   *  HELPER METHODS
   */

  protected static function _element($class, $content, $args) {
    return pb::load('html', 'elements/element.php', array(
      'id'      => $args['id'],
      'class'   => self::_class($class, $args),
      'icon'    => isset($args['icon'])   ? $args['icon']   : false,
      'label'   => isset($args['label'])  ? $args['label']  : false,
      'mobile'  => isset($args['mobile']) ? $args['mobile'] : 'icon',
      'url'     => isset($args['url'])    ? $args['url']    : false,
      'content' => $content,
    ));
  }


  protected static function _link($content, $args, $class = null) {
    if (isset($args['url'])) {
      return '<a href="' . $args['url'] . '" class="' . $class . '">' . $content . '</a>';
    } else {
      return '<span class="' . $class . '">' . $content . '</span>';
    }
  }

  protected static function _class($class, $args) {
    $class .= ' ' . r(isset($args['class']), $args['class']);
    $class .= ' ' . r(isset($args['float']) and $args['float'], 'panelbar-element--right');
    return $class;
  }

  protected static function _style($args) {
    $style = '';
    if (isset($args['style'])) {
      foreach ($args['style'] as $key => $value) {
        $style .= $key . ': ' . $value . ';';
      }
      return ' style="' . $style . '"';
    }
  }

}
