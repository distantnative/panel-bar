<?php

namespace panelBar\Elements;

use panelBar\Build;

class Images extends Base {

  public function html($type = 'image', $function = 'images') {
    if($images = $this->items($this->page, $type)) {
      // register assets
      $this->_iframe($function);

      // prepare output
      $term = $type == 'image' ? 'Images' : 'Files';

      // return output
      return build::images(array(
        'id'     => $function,
        'icon'   => ($type == 'image') ? 'photo'  : 'file',
        'label'  => $term . $this->bubble($images),
        'term'   => $term,
        'items'  => $images,
        'count'  => 'panelBar-images--' . $this->count($images),
        'all'    => $this->page->url('files'),
      ));
    }
  }

  private function count($images) {
    if    (count($images) > 12)  return '12more';
    elseif(count($images) > 2)   return 'default';
    elseif(count($images) == 2)  return '2';
    elseif(count($images) == 1)  return '1';
  }

  public function items($page, $type = null) {
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
