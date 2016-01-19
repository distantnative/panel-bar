<?php

namespace panelBar\Elements;

use panelBar\Pattern;
use panelBar\Tpl;
use panelBar\Assets;

class Files extends \panelBar\Element {

  public function html($type = null) {
    if($files = $this->items($this->page, $type)) {

      $id = (is_null($type) ? 'image' : $type) . 's';

      // register assets
      $this->_iframe($id);
      $this->assets->setHook('css', assets::load('css', 'modules/drop'));
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
      return pattern::element('panelBar-files', $list, array(
        'id'     => $id,
        'icon'   => 'th-list',
        'label'  => $term . $this->bubble($files),
        'class'  => 'panelBar-mDropParent'
      ));
    }
  }


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
