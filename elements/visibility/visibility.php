<?php

namespace Kirby\panelBar;

use Yaml;
use Kirby\panelBar\Blueprint;

class VisibilityElement extends Element {

  protected $sort;

  //====================================
  //   Output
  //====================================

  public function render() {
    if($this->page->ui()->visibility()) {
      $this->asset('css', 'visibility.css');

      // return pattern output
      if($this->page->isVisible()) {
        return $this->pattern('link', [
          'id'     => $this->name(),
          'label'  => $this->l('visible'),
          'icon'   => 'toggle-on',
          'url'    => $this->route('hide/' . $this->page->uri()),
        ]);

      } else {
        $mode = $this->page->parent()->blueprint()->pages()->num()->mode;

        if($this->page->siblings(false)->count() > 0 and ($mode == 'num' or $mode == 'default')) {
          return $this->pattern('dropdown', [
            'id'    => $this->name(),
            'label'  => $this->l('invisible'),
            'icon'   => 'toggle-off',
            'items' => $this->pagelist()
          ]);
        } else {
          return $this->pattern('link', [
            'id'     => $this->name(),
            'label'  => $this->l('invisible'),
            'icon'   => 'toggle-off',
            'url'    => $this->route('show/' . $this->page->uri()),
          ]);
        }


      }
    }
  }


  protected function pagelist() {
    $items = [];
    $route = 'show/' . $this->page->uri();

    foreach($this->page->siblings()->visible() as $sibling) {
      $items[] = [
        'url'   => $this->route($route, ['num' => $sibling->num()]),
        'label' => '&rarr;&nbsp;<span class="space">&nbsp;</span>&nbsp;&larr;',
      ];

      $items[] = ['label' => $sibling->title()];
    }

    $items[] = [
      'url'   => $this->route($route, ['num' => $sibling->num() + 1]),
      'label' => '&rarr;&nbsp;<span class="space">&nbsp;</span>&nbsp;&larr;',
    ];

    return $items;
  }

}
