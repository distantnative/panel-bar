<?php

namespace Kirby\distantnative\panelBar\Elements;

class Files extends Element {

  //====================================
  //   Output
  //====================================

  public function render($type = null) {
    if($files = $this->items($this->page, $type)) {
      // register iFrame output and assets
      $this->withFrame();
      $this->asset('css', 'files.css');
      // this css files

      $term = $type == 'image' ? 'Images' : 'Files';

      // return pattern output
      return $this->pattern('link', [
        'id'      => $this->name(),
        'label'   => $term . $this->withCount($files),
        'icon'    => 'th-list',
        'content' => $this->tpl('list', [
          'items'   => $files,
          'all'     => [
            'label' => $term,
            'url'   => $this->page->url('files'),
          ],
        ]),
        'class'   => 'panelBar-files panelBar-mDropParent'
      ]);
    }
  }


  //====================================
  //   Items
  //====================================

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
