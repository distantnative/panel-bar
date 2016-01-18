<?php

namespace panelBar\Elements;

use C;
use panelBar\Tpl;
use panelBar\Assets;

class Base {

  public function __construct($panelBar) {
    $this->assets   = $panelBar->assets;
    $this->output   = $panelBar->output;

    $this->panel  = $panelBar->panel;
    $this->site   = $this->panel->site();
    $this->page   = $this->panel->page(page()->id());
  }

  protected function bubble($el) {
    return '<span class="panelBar-element__count-bubble">' . count($el) . '</span>';
  }

  protected function _iframe($element) {
    if(c::get('panelbar.enhancedJS', true)) {
      // register assets
      $this->assets->setHook('js', 'siteURL="'.$this->site->url().'";');
      $this->assets->setHook('js',  assets::load('js',  'components/iframe'));
      $this->assets->setHook('js',  'panelBar.iframe.bind(".panelBar--' . $element . ' a");');
      $this->assets->setHook('css', assets::load('css', 'components/iframe'));
      // register output
      $this->output->setHook('before',   tpl::load('iframe/iframe'));
      $this->output->setHook('elements', tpl::load('iframe/btn'));
    }
  }

}
