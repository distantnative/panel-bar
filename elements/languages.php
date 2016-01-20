<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Languages extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    if ($languages = $this->site->languages()) {
      // return output
      return pattern::dropdown(array(
        'id'      => $this->getElementName(),
        'label'   => strtoupper($this->site->language()->code()),
        'icon'    => 'flag',
        'items'   => $this->items(),
        'mobile'  => 'label',
      ));
    }
  }

  //====================================
  //   Items
  //====================================

  private function items() {
    $items = array();

    foreach($this->otherLanguages() as $language) {
      $items[] = array(
        'url'   => $language->url() . '/' . $this->page->uri(),
        'label' => strtoupper($language->code()),
      );
    }

    return $items;
  }

  //====================================
  //   Helpers
  //====================================

  private function otherLanguages() {
    return $languages->not($this->site->language()->code());
  }

}
