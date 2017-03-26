<?php

namespace Kirby\Registry;

use Dir;
use Exception;

class panelBar extends Entry {

	protected static $elements = [];

	public function set($name, $path) {
		if(is_dir($path)) {
			static::$elements[$name] = $path;
			return $path;

		} else if($this->kirby->option('debug')) {
			throw new Exception('panelBar element does not exist at path: ' . $path);
		}
	}

	public function get($name = null) {
		if(is_null($name))                  return static::$elements;
		if(isset(static::$elements[$name])) return static::$elements[$name];

		return false;
	}
}
