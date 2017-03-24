<?php

namespace Kirby\panelBar;

use Dir;
use F;

class Route {

  public static $prefix = 'api/plugin/panel-bar/';

  public function __construct($element, $route) {
    kirby()->set('route', [
      'pattern' => self::$prefix . $element . '/' . $route['pattern'],
      'action'  => $route['action'],
      'method'  => $route['method']
    ]);

  }

  public static function url($element, $route, $parameters= []) {
    $base = kirby()->urls()->index() . '/' . self::$prefix;
    $url  = $base . $element . '/' . $route;

    if(!empty($parameters)) {
      $url .= '?';
      foreach($parameters as $parameter => $value) {
        $url .=  $parameter . '=' . $value;
        if(next($parameters)) $url .= '&';
      }
    }

    return $url;
  }
}
