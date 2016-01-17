<?php

namespace panelBar\Elements;

use panelBar\Build;

class Images extends Base {

  public function html($type = 'image', $function = 'images') {
    if($images = Files::items($this->page, $type)) {
      // register assets
      $this->_iframe($function);

      // prepare output
      $term = $type == 'image' ? 'Images' : 'Files';

      // return output
      return Build::images(array(
        'id'     => $function,
        'icon'   => ($type == 'image') ? 'photo'  : 'file',
        'label'  => $term . $this->bubble($images),
        'term'   => $term,
        'items'  => $images,
        'count'  => 'panelBar-images--' . $this->count($images),
        'all'    => $this->page->url('files'),
      ));
    }
  }

  private function count($images) {
    if    (count($images) > 12)  return '12more';
    elseif(count($images) > 2)   return 'default';
    elseif(count($images) == 2)  return '2';
    elseif(count($images) == 1)  return '1';
  }

}
