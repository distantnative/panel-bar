<?php

namespace Kirby\Registry;

use Dir;
use Exception;

class panelBar extends Entry {

	protected static $elements = [];

	public function set($name, $path) {
		if(is_dir($path)) {
			// Register the new module
			static::$elements[$name] = $path;
			return $path;

		} else if($this->kirby->option('debug')) {
			throw new Exception('The panelBar element does not exist at the specified path: ' . $path);
		}
	}


	public function get($name = null) {
		if(is_null($name)) {
			return static::$elements;
		}

		// Get from registry
		if(isset(static::$elements[$name])) return static::$elements[$name];

		// No match
		return false;
	}
}
