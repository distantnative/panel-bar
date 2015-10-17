<?php

namespace panelBar;

class Build {

  /**
   *  PUBLIC CONSTRUCTORS
   */

  public static function label($args) {
    return array(
      'element' => self::_element('panelBar-label', null, $args),
    );
  }


  public static function link($args) {
    return array(
      'element' => self::_element('panelBar-btn', null, $args),
      'assets'  => array('css' => tools::load('css', 'elements/btn')),
    );
  }


  public static function dropdown($args) {
    $drop = tools::load('html', 'elements/drop', array('items' =>$args['items']));
    $args['class'] = self::_class('panelBar-mDropParent', $args);
    return array(
      'element' => self::_element('panelBar-drop', $drop, $args),
      'assets'  => array('css' => array(
                    tools::load('css', 'elements/drop'),
                    tools::load('css', 'modules/drop'),
                  )),
    );
  }


  public static function images($args) {
    $grid = tools::load('html', 'elements/images', array(
      'items'   => $args['items'],
      'all'     => array(
        'label' => $args['label'],
        'url'   => $args['all'],
      ),
      'count'   => $args['count'],
    ));
    $args['class'] = self::_class('panelBar-mDropParent', $args);
    return array(
      'element' => self::_element('panelBar-images', $grid, $args),
      'assets'  => array('css' => array(
                    tools::load('css', 'elements/images'),
                    tools::load('css', 'modules/drop'),
                  )),
    );
  }


  public static function files($args) {
    $list = tools::load('html', 'elements/files', array(
      'items'   => $args['items'],
      'all'     => array(
        'label' => $args['label'],
        'url'   => $args['all'],
      ),
    ));
    $args['class'] = self::_class('panelBar-mDropParent', $args);
    return array(
      'element' => self::_element('panelBar-files', $list, $args),
      'assets'  => array('css' => array(
                    tools::load('css', 'elements/files'),
                    tools::load('css', 'modules/drop'),
                  )),
    );
  }


  public static function box($args) {
    $box = tools::load('html', 'elements/box', array(
      'style'   => self::_style($args),
      'content' => $args['content'],
    ));
    $args['class'] = self::_class('panelBar-mDropParent', $args);
    return array(
      'element' => self::_element('panelBar-box', $box, $args),
      'assets'  => array('css' => array(
                    tools::load('css', 'elements/box'),
                    tools::load('css', 'modules/drop'),
                  )),
    );
  }




  /**
   *  HELPER METHODS
   */

  public static function _element($class = null, $content = null, $args = array()) {
    if(is_null($content)) {
      $content = isset($args['content']) ? $args['content'] : '';
    }
    return tools::load('html', 'elements/base', array(
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


  private static function _class($class, $args) {
    if(isset($args['class'])) {
      $class .= ' ' . $args['class'];
    }
    if(isset($args['float']) and $args['float']) {
      $class .= ' panelBar-element--right';
    }
    return $class;
  }


  private static function _style($args) {
    $style = '';
    if(isset($args['style'])) {
      foreach($args['style'] as $key => $value) {
        $style .= $key . ': ' . $value . ';';
      }
      $style .= ' style="' . $style . '"';
    }
    return $style;
  }

}
