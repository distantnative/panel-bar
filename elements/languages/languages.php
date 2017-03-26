<?php

namespace Kirby\panelBar;

class LanguagesElement extends Element {

  //====================================
  //   Output
  //====================================
  public function render() {
    if ($languages = $this->site->languages()) {
      $current = $this->site->language()->code();

      // return pattern output
      return $this->pattern('dropdown', [
        'label'  => strtoupper($current),
        'icon'   => 'flag',
        'items'  => $this->items($languages->not($current)),
        'mobile' => 'label'
      ]);
    }
  }

  //====================================
  //   Items
  //====================================
  protected function items($languages) {
    $items = [];

    foreach($languages as $lang) {
      $items[] = [
        'url'   => $lang->url() . '/' . $this->page->uri(),
        'label' => strtoupper($lang->code()),
      ];
    }

    return $items;
  }
}
