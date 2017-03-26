<?php

namespace Kirby\panelBar;

class LoadtimeElement extends Element {

  //====================================
  //   Output
  //====================================
  public function render() {
    // register assets
    $this->asset('js', 'loadtime.min.js');

    // return output
    return $this->pattern('link', [
      'icon'   => 'clock-o',
      'label'  => $this->time(),
      'mobile' => 'label',
    ]);
  }

  //====================================
  //   Helpers
  //====================================
  protected function time() {
    return number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']), 2);
  }

}
