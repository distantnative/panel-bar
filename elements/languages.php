<?php

namespace Kirby\Plugins\distantnative\panelBar\Elements;

class Languages extends Element {

  //====================================
  //   Output
  //====================================

  public function render() {
    if ($languages = $this->site->languages()) {
      // return pattern output
      return $this->pattern('dropdown', [
        'id'     => $this->name(),
        'label'  => strtoupper($this->site->language()->code()),
        'icon'   => 'flag',
        'items'  => $this->items($languages),
        'mobile' => 'label'
      ]);
    }
  }


  //====================================
  //   Items
  //====================================

  protected function items($languages) {
    $items = [];

    foreach($languages->not($this->site->language()->code()) as $language) {
      $items[] = [
        'url'   => $language->url() . '/' . $this->page->uri(),
        'label' => strtoupper($language->code()),
      ];
    }

    return $items;
  }

}
