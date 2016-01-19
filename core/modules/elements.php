<?php

namespace panelBar;

use C;
use panelBar\Tpl;
use panelBar\Assets;

class Element {

  public function __construct($panelBar) {
    $this->core     = $panelBar;
    $this->assets   = $this->core->assets;
    $this->output   = $this->core->output;

    $this->panel    = $this->core->panel;
    $this->site     = $this->panel->site();
    $this->page     = $this->panel->page($this->core->page->id());
  }

  //====================================
  //   Element characteristics
  //====================================

  protected function getElementDir() {
    $root = realpath(__DIR__ . '/../..');
    return $root . DS . 'elements' . DS . $this->getElementName() . DS;
  }

  protected function getElementName() {
    $class     = get_class($this);
    $namespace = 'panelBar\\Elements\\';
    return strtolower(str_replace($namespace, '', $class));
  }

  //====================================
  //   Custom templates & assets loading
  //====================================

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
    return \tpl::load($this->getElementDir() . $path, $array);
  }

  //====================================
  //   Features
  //====================================

  protected function withBubble($items) {
    return '<span class="panelBar-element__count-bubble">' . count($items) . '</span>';
  }

  protected function withIframe($id = null) {
    if(c::get('panelbar.enhancedJS', true)) {
      // register assets
      $this->assets->setHooks(array(
        'js'  => array(
          'siteURL="'.$this->site->url().'";',
          $this->js('components/iframe'),
          'panelBar.iframe.bind(".panelBar--' . (isset($id) ? $id : $this->getElementName()) . ' a");'
        ),
        'css' => $this->css('components/iframe')
      ));

      // register output
      $this->output->setHooks(array(
        'before'   => $this->tpl('components/iframe/frame'),
        'elements' => $this->tpl('components/iframe/btn')
      ));
    }
  }

}
