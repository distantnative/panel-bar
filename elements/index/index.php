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
      'id'      => $this->name(),
      'icon'   => 'th',
      'label'  => 'Index',
      'items'  => $this->items(),
      'class'   => 'panelBar-index panelBar-mDropParent'
    ]);
  }

  //====================================
  //   Items
  //====================================

  protected function items() {
    $home  = $this->site->homePage();
    $index = $this->site->index()->prepend($home->id(), $home);
    $items = [];

    foreach($index as $page) {
      $items[] = [
        'label' => $this->tpl('label', array(
          'title'   => $page->title(),
          'num'     => $page->num(),
          'depth'   => $page->depth() - 1,
          'visible' => $page->isVisible()
        )),
        'url'   => $page->url(),
      ];
    }

    return $items;
  }

}
