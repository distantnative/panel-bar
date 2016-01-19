<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Files extends \panelBar\Element {

  //====================================
  //   HTML output
  //====================================

  public function html($type = null) {
    if($files = $this->items($this->page, $type)) {

      // register assets
      $this->withIframe();
      $this->assets->setHook('css', $this->css('modules/drop'));
      $this->assets->setHook('css', $this->css('files'));

      // prepare output
      $term = $type == 'image' ? 'Images' : 'Files';

      $list = $this->tpl('list', array(
        'items'   => $files,
        'all'     => array(
          'label' => $term,
          'url'   => $this->page->url('files'),
        ),
      ));

      // return output
      return pattern::blank('panelBar-files', $list, array(
        'id'     => $this->getElementName(),
        'icon'   => 'th-list',
        'label'  => $term . $this->withBubble($files),
        'class'  => 'panelBar-mDropParent'
      ));
    }
  }

  //====================================
  //   Helpers
  //====================================

  public function items($page, $type = null) {
    if(!$page->canShowFiles()) return false;

    // get files collection
    $files = $page->files()->sortBy('extension', 'asc', 'name', 'asc');
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);

    if ($files->count() == 0) return false;

    // prepare output
    $items = array();
    foreach($files as $file) {
      $args = array(
        'type'      => $file->type(),
        'url'       => $file->url('edit'),
        'label'     => $file->name(),
        'extension' => $file->extension(),
        'size'      => $file->niceSize(),
      );

      if($file->type() == 'image') $args['image']  = $file->url();
      else                         $args['icon']   = $file->icon();
      array_push($items, $args);
    }

    return $items;
  }

}
