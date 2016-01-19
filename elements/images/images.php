<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Images extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html($type = 'image') {
    if($images = $this->items($this->page, $type)) {

      // register assets
      $this->withIframe();
      $this->assets->setHook('css', $this->css('modules/drop'));
      $this->assets->setHook('css', $this->css('images'));

      // prepare output
      $term = $type == 'image' ? 'Images' : 'Files';

      $grid = $this->tpl('grid', array(
        'items'   => $images,
        'all'     => array(
          'label' => $term,
          'url'   => $this->page->url('files'),
        ),
        'count'   => 'panelBar-images--' . $this->count($images),
      ));

      // return output
      return pattern::blank('panelBar-images', $grid, array(
        'id'     => $this->getElementName(),
        'icon'   => $type == 'image' ? 'photo'  : 'file',
        'label'  => $term . $this->withBubble($images),
        'class'  => 'panelBar-mDropParent',
      ));

    }
  }

  //====================================
  //   Helpers
  //====================================

  private function count($images) {
    if    (count($images) > 12)  return '12more';
    elseif(count($images) > 2)   return 'default';
    elseif(count($images) == 2)  return '2';
    elseif(count($images) == 1)  return '1';
  }

  private function items($page, $type = null) {
    if(!$page->canShowFiles()) return false;

    // get files collection
    $files = $page->files()->sortBy('extension', 'asc', 'name', 'asc');
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);

    if ($files->count() == 0) return false;

    // prepare output
    $items = array();
    foreach($files as $file) {
      $args = array(
        'type'      => $file->type(),
        'url'       => $file->url('edit'),
        'label'     => $file->name(),
        'extension' => $file->extension(),
        'size'      => $file->niceSize(),
      );

      if($file->type() == 'image') $args['image']  = $file->url();
      else                         $args['icon']   = $file->icon();
      array_push($items, $args);
    }

    return $items;
  }

}
