<?php

$kirby = kirby();
$index = $kirby->roots()->index();

// load the panel bootstrapper
require_once($index . DS . 'panel' . DS . 'app' . DS . 'bootstrap.php');

// check for a custom site.php
if(file_exists($index . DS . 'site.php')) {
  // load the custom config
  require($index . DS . 'site.php');
} else {
  // create a new kirby object
  $kirby = kirby();
}

// fix the base url for the kirby installation
if(!isset($kirby->urls->index)) {
  $kirby->urls->index = dirname($kirby->url());
}

// the default index directory
if(!isset($kirby->roots->index)) {
  $kirby->roots->index = $index;
}

// the default avatar directory
if(!isset($kirby->roots->avatars)) {
  $kirby->roots->avatars = $index . DS . 'assets' . DS . 'avatars';
}

// the default thumbs directory
if(!isset($kirby->roots->thumbs)) {
  $kirby->roots->thumbs = $index . DS . 'thumbs';
}

// create the panel object
try {
  return new Panel($kirby, $index . DS . 'panel');
} catch(Exception $e) {
  return $e;
}
