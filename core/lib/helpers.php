<?php

page::$methods['hasSiblings'] = function($page) {
  return $page->siblings(false)->count() > 0;
};
