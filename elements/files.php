<?php

namespace panelBar\Elements;

use panelBar\Build;

class Files extends Base {

  public function html($type = null, $function = 'files') {
    if($files = $this->items($this->page, $type)) {
      // register assets
      $this->_iframe($function);

      // prepare output
      $term = $type == 'image' ? 'Images' : 'Files';

      // return output
      return build::files(array(
        'id'     => $function,
        'icon'   => 'th-list',
        'label'  => $term . $this->bubble($files),
        'term'   => $term,
        'items'  => $files,
        'all'    => $this->page->url('files'),
      ));
    }
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
