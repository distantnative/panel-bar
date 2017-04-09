<?php

namespace Kirby\panelBar;


class PagespeedElement extends Element {

  //====================================
  //   Output
  //====================================
  public function render() {
    $this->asset('css', 'pagespeed.css');
    $this->asset('js',  'pagespeed.min.js');
    $this->component()->content('');

    return $this->pattern('box', [
      'icon'  => 'google',
      'label' => 'PageSpeed',
      'box'   => 'Loading from API… <div data-route="' . $this->route('get/' . $this->page->uri()) . '"></div>'
    ]);
  }
}
