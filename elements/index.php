<?php

namespace panelBar\Elements;

use panelBar\Tools;
use panelBar\Build;

class Index extends Base {

  public function index() {
    // register assets
    $this->assets->setHook('css', tools::load('css', 'elements/index'));

    // return output
    return Build::dropdown(array(
      'id'     => __FUNCTION__,
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
        'label' => tools::load('html', 'elements/index/label', array(
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
