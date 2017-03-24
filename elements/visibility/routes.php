<?php

return [
  'pattern' => '(:any)/(:all)',
  'action'  => function($action, $uri) {
    $panel     = require(dirname(dirname(__DIR__)) . DS . 'core/lib/panel/integrate.php');
    $page      = $panel->page($uri);
    $sort      = $page->parent()->blueprint()->pages()->num();

    if($action == 'hide') {
      $page->hide();

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
