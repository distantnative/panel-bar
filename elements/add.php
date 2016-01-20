<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Add extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html() {
    // register assets
    $this->withIframe();

    // return output
    return pattern::dropdown(array(
      'id'     => $this->getElementName(),
      'label'  => 'Add',
      'icon'   => 'plus',
      'items'  => $this->items(),
    ));
  }

  //====================================
  //   Items
  //====================================

  private function items() {
    $items = array();

    if($this->page->canHaveSubpages()) {
      $items[] = array(
        'url'   => $this->page->url('add'),
        'label' => 'Child',
      );
    }

    if($parent = $this->page->parent() and $parent->canHaveSubpages()) {
      $items[] = array(
        'url'   => $parent->url('add'),
        'label' => 'Sibling',
      );
    }

    return $items;
  }

}
