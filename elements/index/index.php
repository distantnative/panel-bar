<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Assets;

class Index extends \panelBar\Element {

  public function html() {
    // register assets
    $this->assets->setHook('css', assets::load('css', 'elements/index'));

    // return output
    return pattern::dropdown(array(
      'id'     => 'index',
      'icon'   => 'th',
      'label'  => 'Index',
      'items'  => $this->items(),
      'class'  => 'panelBar-index',
    ));
  }

  private function items() {
    $home  = $this->site->homePage();
    $index = $this->site->index()->prepend($home->id(), $home);
    $items = array();

    foreach($index as $page) {
      array_push($items, array(
        'label' => $this->tpl('label', array(
          'title'   => $page->title(),
          'num'     => $page->num(),
          'depth'   => $page->depth() - 1,
          'visible' => $page->isVisible()
        )),
        'url'   => $page->url(),
      ));
    }

    return $items;
  }

}
