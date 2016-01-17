<?php

namespace panelBar\Elements;

use panelBar\Build;

class Images extends Base {

  public function images($type = 'image', $function = __FUNCTION__) {
    if($images = Files::items($this->page, $type)) {
      // register assets
      $this->_iframe($function);

      // return output
      return Build::images(array(
        'id'     => $function,
        'icon'   => ($type == 'image') ? 'photo'  : 'file',
        'label'  => (($type == 'image') ? 'Images' : 'Files') . $this->bubble($images),
        'items'  => $images,
        'count'  => 'panelBar-images--' . count($images),
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
