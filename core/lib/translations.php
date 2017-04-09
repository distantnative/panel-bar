<?php

namespace Kirby\panelBar;

use F;
use L;

class Translations {

  protected function translations() {
    $this->translation('en');
    if($user = site()->user()) $this->translation($user->language());
  }

  protected function translation($lang) {
    $dir = $this->dir() . DS . 'translations';
    f::load($dir . DS . $lang . '.php');
  }

  public function l($key, $data = []) {
    return l::get(implode('.', array_merge(['panelBar'], $key)), $data);
  }

}
