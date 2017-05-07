<?php

// check for a custom site.php
if(file_exists($index . DS . 'site.php')) {
  // load the custom config
  require($index . DS . 'site.php');
} else {
  // create a new kirby object
  $kirby = kirby();
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
