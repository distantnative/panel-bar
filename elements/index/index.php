<?php

namespace Kirby\panelBar;

class IndexElement extends Element {

  //====================================
  //   Output
  //====================================
  public function render() {
    // register assets
    $this->asset('css', 'index.css');

    // return pattern output
    return $this->pattern('dropdown', [
      'icon'   => 'th',
      'label'  => 'Index',
      'items'  => $this->items(),
      'class'   => 'panelBar-index'
    ]);
  }

  //====================================
  //   Items
  //====================================
  protected function items() {
    $items = [];
    $home  = $this->site->homePage();
    $index = $this->site->index()->prepend($home->id(), $home);

    foreach($index as $page) {
      $items[] = [
        'label' => $this->tpl('label', [
          'icon'    => $page->icon(),
          'title'   => $page->title(),
          'num'     => $page->num(),
          'depth'   => $page->depth() - 1,
          'visible' => $page->isVisible()
        ]),
        'url'   => $page->url(),
      ];
    }

    return $items;
  }
}
