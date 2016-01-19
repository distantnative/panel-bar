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
    return $this->load('templates' . DS . $file . '.php', $array);
  }

  protected function css($file, $array = array()) {
    return $this->load('assets/css' . DS . $file . '.css', $array);
  }

  protected function js($file, $array = array()) {
    return $this->load('assets/js/dist' . DS . $file . '.min.js', $array);
  }

  protected function load($path, $array) {
    return \tpl::load($this->dir() . $path, $array);
  }

  protected function dir() {
    $root = realpath(__DIR__ . '/../..');
    return $root . DS . 'elements' . DS . $this->name() . DS;
  }

  protected function name() {
    return strtolower(str_replace('panelBar\\Elements\\', '', get_class($this)));
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
      $this->output->setHook('before',   tpl::load('components/iframe/frame'));
      $this->output->setHook('elements', tpl::load('components/iframe/btn'));
    }
  }

}
