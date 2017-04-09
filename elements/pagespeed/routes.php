<?php

return [
  'pattern' => 'get/(:all)',
  'action'  => function($uri) {
    $url = page($uri)->url();
    $api = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=';

    $box = '<div class="panelBar--pagespeed__wrapper"><div class="panelBar--pagespeed__col">{desktop}</div><div class="panelBar--pagespeed__col">{mobile}</div></div><a href="https://developers.google.com/speed/pagespeed/insights/?url=' . $url . '">See full report</a>';

    foreach(['desktop', 'mobile'] as $strategy) {
      $content = ['### ' . $strategy];
      $result  = json_decode(file_get_contents($api . $url . '&strategy=' . $strategy), true);

      foreach($result['ruleGroups'] as $rule => $group) {
          $content[ucfirst(strtolower($rule)) . ' score'] = '<span style="color: '. getColor($group['score']) . '">' . $group['score'] . '</span>';
      }

      $content = array_merge($content, [
        '##### Number of Resources',
        'Resources'    => $result['pageStats']['numberResources'],
        'CSS'          => $result['pageStats']['numberJsResources'],
        'Javascript'   => $result['pageStats']['numberCssResources'],
        'Static'       => $result['pageStats']['numberStaticResources'],

        '##### Request size',
        'Total size'   => f::niceSize($result['pageStats']['totalRequestBytes']),
        'HTML size'    => f::niceSize($result['pageStats']['htmlResponseBytes']),
        'CSS size'     => f::niceSize($result['pageStats']['cssResponseBytes']),
        'JS size'      => f::niceSize($result['pageStats']['javascriptResponseBytes']),
        'Image size'   => f::niceSize($result['pageStats']['imageResponseBytes']),
        'Other'        => f::niceSize($result['pageStats']['otherResponseBytes']),
        '##### Consider to enhance',
      ]);

      foreach($result['formattedResults']['ruleResults'] as $rules) {
        if($rules['ruleImpact'] > 0) {
          $content[$rules['localizedRuleName']] = $rules['ruleImpact'];
        }
      }


      $content = tpl::load(dirname(dirname(__DIR__)) . DS . 'snippets' . DS . 'components' . DS . 'content.php', ['content' => $content]);
      $box     = str::template($box, [$strategy => $content]);
    }

    return Response::json($box);
  },
  'method' => 'GET'
];

function getColor($power) {
  if($power <= 60) $power = 0;
  else $power = $power - 60;
  $hue = 2.5 * ($power/100) * 90;
  return 'hsl(' . $hue . ', 100%, 30%)';
}
