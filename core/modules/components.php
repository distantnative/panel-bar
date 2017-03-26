<?php

namespace Kirby\panelBar;

use Tpl;

class Components {

  public function __construct($element) {
    $this->element = $element;
    $this->core    = $element->core;
    $this->assets  = $this->core->assets;
    $this->html    = $this->core->html;
  }

  //====================================
  //   Overlay
  //====================================
  public function overlay() {
    $path = 'components' . DS . 'overlay';
    $url  = $this->element->site->url();

    // register assets
    $this->css($path);
    $this->js('siteURL="' . $url . '";', 'tag');
    $this->js($path);
    $this->js('panelBar.overlay.bind(".panelBar--' . $this->element . ' a");', 'tag');

    // register output
    $this->html('pre',      $path . DS . 'frame');
    $this->html('elements', $path . DS . 'links');
  }

  //====================================
  //   Modal
  //====================================
  public function modal($content) {
    $path = 'components' . DS . 'modal';

    // register assets
    $this->css($path);
    $this->js($path);
    $this->js('panelBar.modal.bind(".panelBar--' . $this->element . ' > a", "' . $this->element . '");', 'tag');

    // register output
    $this->html('post', $path . DS . 'overlay');
    $this->html('post', $path . DS . 'modal', [
      'id'      => $this->element,
      'content' => $this->content($content)
    ]);
  }

  //====================================
  //   Content
  //====================================
  public function content($content) {
    $path = 'components' . DS . 'content';
    $this->css($path);
    return $this->render($path, ['content' => $content]);
  }

  //====================================
  //   Count
  //====================================
  public function count($items) {
    $path = 'components' . DS . 'count';
    $this->css($path);
    return $this->render($path, ['count' => count($items)]);
  }

  //====================================
  //   Helper methods
  //====================================
  protected function asset($type, $path, $mode = 'link') {
    $string = $path . ($mode === 'link' ? '.' . $type : '');
    $asset  = $this->assets->{$mode}($type, $string);
    $this->assets->add($type, $asset);
  }

  protected function css($path, $mode = 'link') {
    $this->asset('css', $path, $mode);
  }

  protected function js($path, $mode = 'link') {
    return $this->asset('js', $path, $mode);
  }

  protected function html($hook, $path, $args = []) {
    return $this->html->add($hook, $this->html->load($path, $args));
  }

  protected function render($path, $args = []) {
    return $this->html->load($path, $args);
  }

}
