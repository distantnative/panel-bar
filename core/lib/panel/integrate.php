<?php

// fetch the site's index directory
$kirby  = kirby();
$index  = $kirby->roots()->index();
$root   = $index . DS . 'panel';

include('bootstrap.php');
require('panel.php');

return new Kirby\Panel($kirby, $root);
