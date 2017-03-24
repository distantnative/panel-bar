<?php

namespace Kirby\panelBar;

class ImagesElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($images = $this->items()) {
      // register overlay output and assets
      $this->component()->overlay();
      $this->asset('css', 'images.css');

      // return pattern output
      return $this->pattern('link', [
        'id'      => $this->name(),
        'label'   => 'Images' . $this->component()->count($images),
        'icon'    => 'photo',
        'content' => $this->tpl('grid', [
          'items'   => $images,
          'count'   => count($images),
          'all'     => [
            'label' => 'Images',
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

  public function items() {
    if(!$this->page->ui()->files()) return false;

    // get images collection
    $images = $this->page->images()->sortBy('name', 'asc');
    if ($images->count() == 0) return false;

    // prepare output
    $items = [];
    foreach($images as $image) {
      $items[] = [
        'image'     => $image->url(),
        'url'       => $image->url('edit'),
        'label'     => $image->name(),
        'extension' => $image->extension(),
        'size'      => $image->niceSize(),
      ];
    }

    return $items;
  }

}
