<?php

namespace Kirby\panelBar;

class FilesElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($files = $this->items()) {
      // register output and assets
      $this->component()->overlay();
      $this->asset('css', 'files.css');

      // return pattern output
      return $this->pattern('link', [
        'id'      => $this->name(),
        'label'   => 'Files' . $this->component()->count($files),
        'icon'    => 'th-list',
        'content' => $this->tpl('list', [
          'items'   => $files,
          'all'     => [
            'label' => 'Files',
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

  public function items() {
    if(!$this->page->ui()->files()) return false;

    // get files collection
    $files = $this->page->files()->sortBy('extension', 'asc', 'name', 'asc');
    if ($files->count() == 0) return false;

    // prepare output
    $items = array();
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
      $items[] = $args;
    }

    return $items;
  }

}
