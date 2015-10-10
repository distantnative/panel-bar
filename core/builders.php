<?php

namespace PanelBar;

use A;

class Build {

  public $buildAssets = array();

  /**
   *  PUBLIC CONSTRUCTORS
   */

  public static function label($args) {
    return self::_element('panelbar-label', '', $args);

    return array(
      'element' => self::_element('panelbar-label', '', $args),
      'assets'  => array('css' => pb::load('css', 'elements/label.css')),
    );
  }

  public static function link($args) {
    return self::_element('panelbar-btn', '', $args);

    return array(
      'element' => self::_element('panelbar-btn', '', $args),
      'assets'  => array('css' => pb::load('css', 'elements/btn.css')),
    );
  }

  public static function dropdown($args) {
    $drop = pb::load('html', 'elements/drop.php' , array('items' =>$args['items']));

    return array(
      'element' => self::_element('panelbar-drop', $drop, $args),
      'assets'  => array('css' => pb::load('css', 'elements/drop.css')),
    );
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

    return array(
      'element' => self::_element('panelbar-fileviewer', $grid, $args),
      'assets'  => array('css' => pb::load('css', 'elements/fileviewer.css')),
    );
  }

  public static function box($args) {
    $box = pb::load('html', 'elements/box.php', array(
      'style'   => self::_style($args),
      'content' => $args['content'],
    ));

    return array(
      'element' => self::_element('panelbar-box', $box, $args),
      'assets'  => array('css' => pb::load('css', 'elements/box.css')),
    );
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

  protected static function _class($class, $args) {
    if(isset($args['class'])) {
      $class .= ' ' . $args['class'];
    }
    if(isset($args['float']) and $args['float']) {
      $class .= ' panelbar-element--right';
    }
    return $class;
  }

  protected static function _style($args) {
    $style = '';
    if(isset($args['style'])) {
      foreach($args['style'] as $key => $value) {
        $style .= $key . ': ' . $value . ';';
      }
      return ' style="' . $style . '"';
    }
  }

}
