<?php

namespace Kirby\panelBar;

use Yaml;

class Blueprint {

  public $blueprint;

  public function __construct($page) {
    $template         = $page->intendedTemplate();
    $this->blueprint  = yaml::decode(kirby()->get('blueprint', $template));
  }

  public static function read($page) {
    return new self($page);
  }

  public function sort($raw = false) {
    if(!isset($this->blueprint['pages']['num'])) {
      return 'num';
    } else {
      $num = $this->blueprint['pages']['num'];
      if($raw) {
        return $num;
      } else {
        return is_array($num) ? $num['mode'] : $num;
      }
    }
  }

  public function __toArray() {
    return $this->blueprint;
  }


}
