<?php

return [
  'pattern' => '(:any)/(:all)',
  'action'  => function($action, $uri) {
    $page      = page($uri);
    $blueprint = Kirby\panelBar\Blueprint::read($page->parent());
    $sort      = $blueprint->sort();


    if($action == 'hide') {
      $page->hide();

      switch ($sort) {
        case 'num':
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

      switch ($sort) {
        case 'zero':
          $page->sort(0);
          break;

        case 'num':
          $num = get('num');
          foreach($page->siblings()->visible() as $sibling) {
            if($sibling->num() < $num) continue;
            $sibling->sort($sibling->num() + 1);
          }
          $page->sort($num);
          break;

        case 'date':
          $options = $blueprint->sort(true);
          $field   = a::get($options, 'field', 'date');
          $format  = a::get($options, 'format', 'Ymd');
          $page->sort(date($format, $page->{$field}()));
          break;

        default:
          break;
      }

      $num = get('num');
      $page->sort($num);
    }

    go($page->url());
  },
  'method' => 'GET'
];
