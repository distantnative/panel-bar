<?php

namespace panelBar\Elements;

use panelBar\Pattern;

class Add extends \panelBar\Element {

  public function html() {
    // register assets
    $this->_iframe('add');

    // return output
    return pattern::dropdown(array(
      'id'     => 'add',
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => $this->items(),
    ));
  }

  private function items() {
    $items = array();
    if($this->page->canHaveSubpages()) {
      array_push($items, array(
        'url'   => $this->page->url('add'),
        'label' => 'Child',
      ));
    }
    if($parent = $this->page->parent() and $parent->canHaveSubpages()) {
      array_push($items, array(
        'url'   => $parent->url('add'),
        'label' => 'Sibling',
      ));
    }
    return $items;
  }

}
