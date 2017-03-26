<?php

namespace Kirby\panelBar;

class NavigationElement extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if($items = $this->items()) {
      // register overlay output and assets
      $this->asset('css', 'navigation.css');

      // return pattern output
      return $this->pattern('dropdown', [
        'id'    => $this->name(),
        'label' => 'Navigation',
        'icon'  => 'unsorted',
        'items' => $this->items()
      ]);
    }
  }


  //====================================
  //   Items
  //====================================

  protected function items() {
    $page  = page($this->page);
    $items = [];

    if($parent = $page->parent() and !$parent->is(site())) {
      $items[] = [
        'class' => 'parent',
        'url'   => $parent->url(),
        'label' => '<i class="fa fa-angle-double-up"></i> ' . $parent->title(),
      ];
    }

    $prev = $page->prev();
    $next = $page->next();

    if($prev) {
      $items[] = [
        'url'   => $prev->url(),
        'label' => $prev->title(),
        'class' => 'sibling prev' . ($next ? ' both' : '')
      ];
    }


    if($next) {
      $items[] = [
        'url'   => $next->url(),
        'label' => $next->title(),
        'class' => 'sibling next' . ($prev ? ' both' : '')
      ];
    }

    foreach($page->children() as $child) {
      $items[] = [
        'url'   => $child->url(),
        'label' => '<i class="fa ' . ($child->isVisible() ? 'fa-eye' : 'fa-eye-slash') . '"></i>' . $child->title(),
        'class' => 'child'
      ];
    }

    return $items;
  }

}
