<?php

// fetch the site's index directory
$kirby  = kirby();
$index  = $kirby->roots()->index();
$root   = $index . DS . 'panel';

require('panel.php');
include('bootstrap.php');
include('site.php');

return new Kirby\Panel($kirby, $root);
