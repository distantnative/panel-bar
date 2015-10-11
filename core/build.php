<?php

namespace PanelBar;

use A;

class Build {

  public $buildAssets = array();

  /**
   *  PUBLIC CONSTRUCTORS
   */

  public static function label($args) {
    return array(
      'element' => self::_element('panelbar-label', null, $args)
    );
  }

  public static function link($args) {
    return array(
      'element' => self::_element('panelbar-btn', null, $args),
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

  protected static function _element($class = null, $content = null, $args = array()) {
    if(is_null($content)) {
      $content = isset($args['content']) ? $args['content'] : '';
    }

    return pb::load('html', 'elements/base.php', array(
      'class'   => self::_class($class, $args),
      'id'      => isset($args['id'])      ? $args['id']     : '',
      'title'   => isset($args['title'])   ? $args['title']  : '',
      'icon'    => isset($args['icon'])    ? $args['icon']   : false,
      'label'   => isset($args['label'])   ? $args['label']  : false,
      'mobile'  => isset($args['mobile'])  ? $args['mobile'] : 'icon',
      'compact' => isset($args['compact']) ? $args['compact'] : true,
      'url'     => isset($args['url'])     ? $args['url']    : false,
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
