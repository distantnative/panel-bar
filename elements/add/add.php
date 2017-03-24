<?php

namespace Kirby\panelBar;

class AddElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    // register overlay output and assets
    $this->component()->overlay();

    // return pattern output
    return $this->pattern('dropdown', [
      'id'    => $this->name(),
      'label' => 'Add',
      'icon'  => 'plus',
      'items' => $this->items()
    ]);
  }


  //====================================
  //   Items
  //====================================

  protected function items() {
    $items = [];

    // Add Child entry
    if($this->page->ui()->pages()) {
      $items[] = [
        'url'   => $this->page->url('add'),
        'label' => 'Child',
      ];
    }

    // Add Sibling entry
    if($parent = $this->page->parent() and $parent->ui()->pages()) {
      $items[] = [
        'url'   => $parent->url('add'),
        'label' => 'Sibling',
      ];
    }

    return $items;
  }

}
