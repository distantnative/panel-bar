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
      'element' => self::_element('panelbar-label', null, $args),
    );
  }


  public static function link($args) {
    return array(
      'element' => self::_element('panelbar-btn', null, $args),
      'assets'  => array('css' => tools::load('css', 'elements/btn.css')),
    );
  }


  public static function dropdown($args) {
    $drop = tools::load('html', 'elements/drop.php', array('items' =>$args['items']));
    return array(
      'element' => self::_element('panelbar-drop', $drop, $args),
      'assets'  => array('css' => tools::load('css', 'elements/drop.css')),
    );
  }


  public static function images($args) {
    $grid = tools::load('html', 'elements/images.php', array(
      'items'   => $args['items'],
      'all'     => array(
        'label' => $args['label'],
        'url'   => $args['all'],
      ),
      'count'   => $args['count'],
    ));
    return array(
      'element' => self::_element('panelbar-images', $grid, $args),
      'assets'  => array('css' => tools::load('css', 'elements/images.css')),
    );
  }


  public static function files($args) {
    $list = tools::load('html', 'elements/files.php', array(
      'items'   => $args['items'],
      'all'     => array(
        'label' => $args['label'],
        'url'   => $args['all'],
      ),
    ));
    return array(
      'element' => self::_element('panelbar-files', $list, $args),
      'assets'  => array('css' => tools::load('css', 'elements/files.css')),
    );
  }


  public static function box($args) {
    $box = tools::load('html', 'elements/box.php', array(
      'style'   => self::_style($args),
      'content' => $args['content'],
    ));
    return array(
      'element' => self::_element('panelbar-box', $box, $args),
      'assets'  => array('css' => tools::load('css', 'elements/box.css')),
    );
  }




  /**
   *  HELPER METHODS
   */

  public static function _element($class = null, $content = null, $args = array()) {
    if(is_null($content)) {
      $content = isset($args['content']) ? $args['content'] : '';
    }
    return tools::load('html', 'elements/base.php', array(
      'class'   => self::_class($class, $args),
      'id'      => isset($args['id'])      ? $args['id']      : '',
      'title'   => isset($args['title'])   ? $args['title']   : '',
      'icon'    => isset($args['icon'])    ? $args['icon']    : false,
      'label'   => isset($args['label'])   ? $args['label']   : false,
      'mobile'  => isset($args['mobile'])  ? $args['mobile']  : 'icon',
      'compact' => isset($args['compact']) ? $args['compact'] : false,
      'url'     => isset($args['url'])     ? $args['url']     : false,
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
