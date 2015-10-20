<?php

namespace panelBar\Elements;

use panelBar\Tools;
use panelBar\Build;

class Files extends Base {

  public function files($type = null, $function = __FUNCTION__) {
    if($files = static::items($this->page, $type)) {
      // register assets
      $this->_iframe($function);

      // return output
      return Build::files(array(
        'id'     => $function,
        'icon'   => 'th-list',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $files,
        'all'    => $this->page->url('files'),
      ));
    }
  }


  public static function items($page, $type = null) {
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
      else                         $args['icon']   = tools::fileicon($file);
      array_push($items, $args);
    }

    return $items;
  }

}
