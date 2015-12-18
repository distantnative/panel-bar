<?php

namespace panelBar\Elements;

use C;
use panelBar\Tools;

class Base {

  public function __construct($page, $output, $assets) {
    $this->output = $output;
    $this->assets = $assets;

    $this->panel  = panel();
    $this->site   = $this->panel->site();
    $this->page   = $this->panel->page($page->id());
  }


  protected function _iframe($element) {
    if(c::get('panelbar.enhancedJS', true)) {
      // register assets
      $this->assets->setHook('js', 'siteURL="'.$this->site->url().'";');
      $this->assets->setHook('js',  tools::load('js',  'components/iframe'));
      $this->assets->setHook('js',  'panelBar.iframe.bind(".panelBar--' . $element . ' a");');
      $this->assets->setHook('css', tools::load('css', 'components/iframe'));
      // register output
      $this->output->setHook('before',   tools::load('html', 'iframe/iframe'));
      $this->output->setHook('elements', tools::load('html', 'iframe/btn'));
    }
  }

}
