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

    if($prev = $page->prev()) {
      $items[] = [
        'url'   => $prev ? $prev->url() : null,
        'label' => $prev ? $prev->title() : '&nbsp;',
        'class' => 'sibling prev' . ($prev ? '' : ' empty')
      ];
    }


    if($next = $page->next()) {
      $items[] = [
        'url'   => $next ? $next->url() : null,
        'label' => $next ? $next->title() : '&nbsp;',
        'class' => 'sibling next' . ($next ? '' : ' empty')
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
