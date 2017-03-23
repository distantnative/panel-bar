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
    if(!isset($blueprint['pages']['num'])) {
      return 'num';
    } else {
      if($raw) {
        return $blueprint['pages']['num'];
      } else {
        return is_array($blueprint['pages']['num']) ? $blueprint['pages']['num']['mode'] : $blueprint['pages']['num'];
      }
    }
  }


}
