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
        'label'   => $this->l('label') . $this->component()->count($images),
        'icon'    => 'photo',
        'class'   => 'panelBar-images panelBar-mDropParent',
        'content' => $this->tpl('grid', [
          'items'   => $images,
          'count'   => count($images),
          'all'     => [
            'label' => $this->l('all'),
            'url'   => $this->page->url('files'),
          ],
        ])
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
