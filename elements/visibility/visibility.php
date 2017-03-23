<?php

namespace Kirby\panelBar;

use Yaml;
use Kirby\panelBar\Blueprint;

class VisibilityElement extends Element {

  protected $sort;

  public function __construct($core) {
    parent::__construct($core);

    $this->sort = Blueprint::read($this->page->parent())->sort();
  }

  //====================================
  //   Output
  //====================================

  public function render() {
    $this->asset('css', 'visibility.css');

    // return pattern output
    if($this->page->isVisible()) {
      return $this->pattern('link', [
        'id'     => $this->name(),
        'label'  => 'Visible',
        'icon'   => 'toggle-on',
        'url'    => $this->route('hide/' . $this->page->uri()),
      ]);

    } else {

      switch ($this->sort) {
        case 'num':
          return $this->pattern('dropdown', [
            'id'    => $this->name(),
            'label'  => 'Invisible',
            'icon'   => 'toggle-off',
            'items' => $this->pagelist()
          ]);
          break;

        default:
          return $this->pattern('link', [
            'id'     => $this->name(),
            'label'  => 'Invisible',
            'icon'   => 'toggle-off',
            'url'    => $this->route('show/' . $this->page->uri()),
          ]);
          break;
      }


    }
  }


  protected function pagelist() {
    $items = [];
    $route = 'show/' . $this->page->uri();

    foreach($this->page->siblings()->visible() as $sibling) {
      $items[] = [
        'url'   => $this->route($route, ['num' => $sibling->num()]),
        'label' => '&rarr;&nbsp;&nbsp;&larr;',
      ];

      $items[] = ['label' => $sibling->title()];
    }

    $items[] = [
      'url'   => $this->route($route, ['num' => $sibling->num() + 1]),
      'label' => '&rarr; &larr;',
    ];

    return $items;
  }

}
