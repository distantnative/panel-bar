<?php

namespace Kirby\Panel\Models;

use Dir;

class panelBar {

  public function __construct() {

    $this->config   = new \Kirby\panelBar\Config;
    $this->elements = $this->config->elements();
    $this->all      = \Kirby\panelBar\Elements::all();
  }

  public function elements() {
    return array_merge($this->active(), array_diff($this->all(), $this->active()));
  }

  public function active() {
    return $this->elements;
  }

  public function all() {
    return $this->all;
  }

  public function standard() {
    return dir::read(dirname(dirname(__DIR__)) . DS . 'elements');
  }

  public function custom() {
    return array_diff($this->all(), $this->standard());
  }

  public function element($name) {
    return $this->config->element($name);
  }

  public function url($api = '') {
    return kirby()->urls()->index() . '/api/plugin/panel-bar/' . $api;
  }

  public function topbar($topbar) {
    $topbar->append(false, 'Plugins');
    $topbar->append(purl('plugin/panel-bar'), 'panelBar');
  }

}
