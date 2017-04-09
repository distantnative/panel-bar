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
          'label' => $this->l('visible'),
          'icon'  => 'toggle-on',
          'url'   => $this->route('hide/' . $this->page->uri()),
          'title' => $this->l('makeinvisible')
        ]);

      } else {
        $blueprint = $this->page->parent()->blueprint();
        $mode      = $blueprint->pages()->num()->mode;

        if($this->page->hasSiblings() and ($mode == 'num' or $mode == 'default')) {
          return $this->pattern('dropdown', [
            'label' => $this->l('invisible'),
            'icon'  => 'toggle-off',
            'items' => $this->pagelist(),
            'title' => $this->l('makevisible')
          ]);
        } else {
          return $this->pattern('link', [
            'label' => $this->l('invisible'),
            'icon'  => 'toggle-off',
            'url'   => $this->route('show/' . $this->page->uri()),
            'title' => $this->l('makevisible')
          ]);
        }
      }
    }
  }

  //====================================
  //   Page list
  //====================================
  protected function pagelist() {
    $items = [];

    foreach($this->page->siblings()->visible() as $sibling) {
      $items[] = $this->insertPosition($sibling->num(), 'setbefore', $sibling->title());
      $items[] = ['label' => $sibling->title()];
    }

    $items[] = $this->insertPosition($sibling->num() + 1, 'setafter', $sibling->title());

    return $items;
  }

  protected function insertPosition($num, $l, $title) {
    return [
      'url'   => $this->route('show/' . $this->page->uri(), ['num' => $num]),
      'label' => $this->space(),
      'title' => $this->l($l, ['page' => $title])
    ];
  }

  //====================================
  //   Helper methods
  //==================================
  protected function space() {
    return '&rarr;&nbsp;<span class="space">&nbsp;</span>&nbsp;&larr;';
  }

}
