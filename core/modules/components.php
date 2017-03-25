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

  public function element() {
    return $this->element->name();
  }

  //====================================
  //   Overlay
  //====================================
  public function overlay() {
    $path   = 'components' . DS . 'overlay';

    $this->assets->add('js', [
      $this->assets->tag('js', 'siteURL="' . $this->element->site->url() . '";'),
      $this->assets->link('js', $path . '.js'),
      $this->assets->tag('js',  'panelBar.overlay.bind(".panelBar--' . $this->element() . ' a");'),
    ]);

    $this->assets->add('css', $this->assets->link('css', $path . '.css'));

    // register output
    $this->html->add('pre',      $this->html->load($path . DS . 'frame.php'));
    $this->html->add('elements', $this->html->load($path . DS . 'links.php'));
  }

  //====================================
  //   Modal
  //====================================
  public function modal($content) {
    $path = 'components' . DS . 'modal';

    $this->assets->add('css', [
      $this->assets->link('css', $path . '.css'),
    ]);
    $this->assets->add('js', [
      $this->assets->link('js', $path . '.js'),
      $this->assets->tag('js', 'panelBar.modal.bind(".panelBar--' . $this->element() . ' > a", "' . $this->element() . '");'),
    ]);

    $this->html->add('post', $this->html->load($path . '.php', [
      'id'      => $this->element(),
      'content' => $this->content($content)
    ]));
  }

  //====================================
  //   Content
  //====================================
  public function content($content) {
    $this->assets->add('css', [
      $this->assets->link('css', 'components' . DS . 'content.css'),
    ]);

    return $this->html->load('components' . DS . 'content.php', [
      'content' => $content
    ]);
  }

  //====================================
  //   Count
  //====================================
  public function count($items) {
    $this->assets->add('css', [
      $this->assets->link('css', 'components' . DS . 'count.css'),
    ]);

    return $this->html->load('components' . DS . 'count.php', [
      'count' => count($items)
    ]);
  }


}
