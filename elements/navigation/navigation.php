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

      $pattern = [
        'label' => 'Navigation',
        'icon'  => 'unsorted',
        'items' => $this->items(),
      ];

      // styling helper CSS class
      if($this->page->hasParent()) {
        $pattern['class'] = 'with-parent';
      }

      // return pattern output
      return $this->pattern('dropdown', $pattern);
    }
  }

  //====================================
  //   Items
  //====================================
  protected function items() {
    $page  = page($this->page);
    $items = [];
    $items = $this->parent($items, $page);
    $items = $this->siblings($items, $page);
    $items = $this->children($items, $page);
    return $items;
  }

  protected function parent($items, $page) {
    if($page->hasParent()) {
      $parent = $page->parent();
      $items[] = [
        'url'   => $parent->url(),
        'label' => '<i class="fa fa-angle-double-up"></i> ' . $parent->title(),
        'class' => 'panelBar--navigation__parent',
        'title' => $this->title($parent, 'parent')
      ];
    }

    return $items;
  }

  protected function siblings($items, $page) {
    $prev = $page->prev();
    $next = $page->next();

    if($prev) {
      $items[] = [
        'url'   => $prev->url(),
        'label' => $this->panel->page($prev)->icon() . '&nbsp;&nbsp;' . $prev->title(),
        'class' => 'panelBar--navigation__sibling prev' . ($next ? ' both' : ''),
        'title' => $this->title($prev, 'prevsibling')
      ];
    }

    if($next) {
      $items[] = [
        'url'   => $next->url(),
        'label' => $this->panel->page($next)->icon() . '&nbsp;&nbsp;' . $next->title(),
        'class' => 'panelBar--navigation__sibling next' . ($prev ? ' both' : ''),
        'title' => $this->title($next, 'nextsibling')
      ];
    }

    return $items;
  }

  protected function children($items, $page) {
    foreach($page->children() as $child) {
      $items[] = [
        'url'   => $child->url(),
        'label' => $this->panel->page($child)->icon() . '<i class="panelBar--navigation__eye fa fa-circle" aria-hidden="true"></i><i class="panelBar--navigation__eye fa ' . ($child->isVisible() ? 'fa-eye' : 'fa-eye-slash') . '"></i>' . $child->title(),
        'class' => 'panelBar--navigation__child panelBar--navigation--' . ($child->isVisible() ? 'visible' : 'invisible'),
        'title' => $this->title($child, 'child'),
      ];
    }

    return $items;
  }

  //====================================
  //   Helper methods
  //====================================
  protected function title($page, $key) {
    return $this->l($key) . ': ' . $page->title();
  }
}
