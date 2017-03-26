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
      $pattern = [
        'id'    => $this->name(),
        'label' => 'Navigation',
        'icon'  => 'unsorted',
        'items' => $this->items(),
      ];

      if($this->page->hasParent()) {
        $pattern['class'] = 'with-parent';
      }

      return $this->pattern('dropdown', $pattern);
    }
  }


  //====================================
  //   Items
  //====================================

  protected function items() {
    $page  = page($this->page);
    $items = [];

    if($page->hasParent()) {
      $parent = $page->parent();
      $items[] = [
        'class' => 'parent',
        'url'   => $parent->url(),
        'label' => '<i class="fa fa-angle-double-up"></i> ' . $parent->title(),
        'title' => $this->title($parent, 'parent')
      ];
    }

    $prev = $page->prev();
    $next = $page->next();

    if($prev) {
      $items[] = [
        'url'   => $prev->url(),
        'label' => $prev->title(),
        'class' => 'sibling prev' . ($next ? ' both' : ''),
        'title' => $this->title($prev, 'prevsibling')
      ];
    }


    if($next) {
      $items[] = [
        'url'   => $next->url(),
        'label' => $next->title(),
        'class' => 'sibling next' . ($prev ? ' both' : ''),
        'title' => $this->title($next, 'nextsibling')
      ];
    }

    foreach($page->children() as $child) {
      $items[] = [
        'url'   => $child->url(),
        'label' => '<i class="fa ' . ($child->isVisible() ? 'fa-eye' : 'fa-eye-slash') . '"></i>' . $child->title(),
        'class' => 'child',
        'title' => $this->title($child, 'child')
      ];
    }

    return $items;
  }

  protected function title($page, $key) {
    return $this->l($key) . ': ' . $page->title();
  }

}
