<?php

namespace panelBar\Elements;

use panelBar\Build;

class Languages extends Base {

  public function languages() {
    if ($languages = $this->site->languages()) {
      // return output
      return Build::dropdown(array(
        'id'      => __FUNCTION__,
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
