<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Languages extends \panelBar\Element {

  public function html() {
    if ($languages = $this->site->languages()) {
      // return output
      return pattern::dropdown(array(
        'id'      => 'languages',
        'icon'    => 'flag',
        'label'   => strtoupper($this->site->language()->code()),
        'items'   => $this->items(),
        'mobile'  => 'label',
      ));
    }
  }

  private function items() {
    $items = array();
    foreach($languages->not($this->site->language()->code()) as $language) {
      array_push($items, array(
        'url'   => $language->url() . '/' . $this->page->uri(),
        'label' => strtoupper($language->code()),
      ));
    }
    return $items;
  }

}
