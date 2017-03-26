<?php

return [
  'pattern' => '(:any)/(:all)',
  'action'  => function($action, $uri) {
    $root  = dirname(dirname(__DIR__));
    $panel = require($root . DS . 'core/lib/panel/integrate.php');
    $page  = $panel->page($uri);
    $sort  = $page->parent()->blueprint()->pages()->num();

    //====================================
    //   Make invisible
    //==================================
    if($action == 'hide') {
      // hide the page
      $page->hide();

      // re-sort visible siblings
      switch($sort->mode) {
        case 'num':
        case 'default';
          $num = 1;
          foreach($page->siblings()->visible() as $sibling) {
            $sibling->sort($num);
            $num++;
          }
          break;
        default:
          break;
      }

    //====================================
    //   Make visible
    //==================================
    } else {
      switch($sort->mode) {
        case 'zero':
          $page->sort(0);
          break;

        case 'num':
        case 'default':
          $num = get('num');
          foreach($page->siblings()->visible() as $sibling) {
            if($sibling->num() < $num) continue;
            $sibling->sort($sibling->num() + 1);
          }
          $page->sort($num);
          break;

        case 'date':
          $page->sort(date($sort->format, $sort->{$sort->field}()));
          break;

        default:
          break;
      }
    }

    go($page->url());
  },
  'method' => 'GET'
];
