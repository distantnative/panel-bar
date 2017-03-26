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
      'label' => $this->l('label'),
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
        'label' => $this->l('child'),
        'title' => $this->l('label') . ' ' . $this->l('child')
      ];
    }

    // Add Sibling entry
    if($parent = $this->page->parent() and $parent->ui()->pages()) {
      $items[] = [
        'url'   => $parent->url('add'),
        'label' => $this->l('sibling'),
        'title' => $this->l('label') . ' ' . $this->l('sibling')
      ];
    }

    return $items;
  }

}
