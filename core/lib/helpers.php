<?php

page::$methods['hasParent'] = function($page) {
  return $parent = $page->parent() and !$parent->is(site());
};

page::$methods['hasSiblings'] = function($page) {
  return $page->siblings(false)->count() > 0;
};
