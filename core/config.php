<?php

namespace Kirby\panelBar;

use A;
use C;
use F;
use Yaml;

class Config {

  public $elements;

  public function __construct() {
    $this->file   = kirby()->roots()->config() . DS . 'panelBar.yml';
    $this->config = f::exists($this->file) ? yaml::read($this->file) : c::get('panelBar.elements', Elements::$defaults);
  }

  public function elements() {
    return array_map(function($key, $value) {
      return is_numeric($key) ? $value : $key;
    }, array_keys($this->config), $this->config);
  }

  public function element($element) {
    return a::get($this->config, (string)$element, false);
  }

  public function set($config = []) {
    return yaml::write($this->file, $config);
  }

  public function clear() {
    return f::remove($this->file);
  }

}
