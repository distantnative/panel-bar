<?php

namespace panelBar;

use C;
use panelBar\Tpl;
use panelBar\Assets;

class Element {

  public function __construct($panelBar) {
    $this->assets   = $panelBar->assets;
    $this->output   = $panelBar->output;

    $this->panel  = $panelBar->panel;
    $this->site   = $this->panel->site();
    $this->page   = $this->panel->page($panelBar->page->id());
  }

  protected function tpl($file, $array = array()) {
    $root    = realpath(__DIR__ . '/../..');
    $element = strtolower(str_replace('panelBar\\Elements\\', '', get_class($this)));
    $path = $root . DS . 'elements' . DS . $element . DS . 'templates' . DS . $file . '.php';
    echo $path;
    return \tpl::load($path, $array);

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
