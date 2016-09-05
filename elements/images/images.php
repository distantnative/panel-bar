<?php

namespace Kirby\panelBar;

class ImagesElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render($type = 'image') {
    if($images = $this->items($this->page, $type)) {
      // register iFrame output and assets
      $this->withFrame();
      $this->asset('css', 'images.css');
      // this css files

      $term = $type == 'image' ? 'Images' : 'Files';

      // return pattern output
      return $this->pattern('link', [
        'id'      => $this->name(),
        'label'   => $term . $this->withCount($images),
        'icon'    => $type == 'image' ? 'photo'  : 'file',
        'content' => $this->tpl('grid', [
          'items'   => $images,
          'count'   => count($images),
          'all'     => [
            'label' => $term,
            'url'   => $this->page->url('files'),
          ],
        ]),
        'class'   => 'panelBar-images panelBar-mDropParent'
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
    $items = [];
    foreach($files as $file) {
      $args = [
        'type'      => $file->type(),
        'url'       => $file->url('edit'),
        'label'     => $file->name(),
        'extension' => $file->extension(),
        'size'      => $file->niceSize(),
      ];

      if($file->type() == 'image') $args['image']  = $file->url();
      else                         $args['icon']   = $file->icon();
      array_push($items, $args);
    }

    return $items;
  }

}
