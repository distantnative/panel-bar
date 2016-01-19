<?php

namespace panelBar;

use C;
use panelBar\Tpl;
use panelBar\Assets;

class Element {

  public function __construct($panelBar) {
    $this->assets   = $panelBar->assets;
    $this->output   = $panelBar->output;

    $this->panel    = $panelBar->panel;
    $this->site     = $this->panel->site();
    $this->page     = $this->panel->page($panelBar->page->id());
  }

  protected function tpl($file, $array = array()) {
    if($tpl = $this->load('templates' . DS . $file . '.php', $array)) {
      return $tpl;
    } else {
      return tpl::load($file, $array);
    }
  }

  protected function css($file, $array = array()) {
    if($css = $this->load('assets/css' . DS . $file . '.css', $array)) {
      return $css;
    } else {
      return assets::load('css', $file, $array);
    }
  }

  protected function js($file, $array = array()) {
    if($js = $this->load('assets/js/dist' . DS . $file . '.min.js', $array)) {
      return $js;
    } else {
      return assets::load('js', $file, $array);
    }
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
      $this->assets->setHook('js',  $this->js('components/iframe'));
      $this->assets->setHook('js',  'panelBar.iframe.bind(".panelBar--' . $element . ' a");');
      $this->assets->setHook('css', $this->css('components/iframe'));
      // register output
      $this->output->setHook('before',   $this->tpl('components/iframe/frame'));
      $this->output->setHook('elements', $this->tpl('components/iframe/btn'));
    }
  }

}
