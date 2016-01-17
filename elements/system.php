<?php

namespace panelBar\Elements;

require_once(__DIR__ . '/../vendor/github/client/GitHubClient.php');

use panelBar\Build;
use panelBar\Tools;
use C;
use Toolkit;
use Kirby;

class System extends Base {

  public function system() {
    // register assets
    $this->assets->setHook('css', tools::load('css', 'elements/system'));

    // return output
    return Build::box(array(
      'id'      => __FUNCTION__,
      'icon'    => 'info',
      'label'   => 'System',
      'content' => $this->content()
    ));
  }

  private function content() {
    $content  = '<ul>';
    $content .= $this->version('Kirby');
    $content .= $this->version('Toolkit');
    $content .= $this->version('Panel');
    $content .= '</ul>';
    return $content;
  }

  private function version($repo) {
    if(c::get('panelbar.system.api', true)) {
      $this->github = isset($this->github) ? $this->github : new \GitHubClient();
      $api      = $this->github->repos->listTags('getkirby', $repo);
      $version  = $api[0]->getName();
      $status   = ($version == $repo::version()) ? 'same' : 'older';
    } else {
      $status   = 'unknown';
    }

    return '<li><span>' . $repo . ':</span> <em class="version--' . $status . '">' . $repo::version() . '</em></li>';
  }

}
