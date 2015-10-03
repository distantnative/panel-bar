<?php

namespace PanelBar;

use Tpl;

use PanelBar\PB;
use PanelBar\Helpers;

class Elements {

  public $site;
  public $page;

  protected $output;
  protected $templates;
  protected $assets;
  protected $css;
  protected $js;

  public function __construct($output, $assets) {
    $this->site   = site();
    $this->page   = page();

    $this->output = $output;
    $this->assets = $assets;
  }


  /**
   *  PANEL
   */

  public function panel() {
    // register assets
    $this->assets->setHook('css', pb::load('css', 'elements/btn.css'));

    // register output
    $this->output->setHook('elements', Helpers::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => pb::purl(site()->url().'/panel'),
      'label'   => 'Panel',
      'mobile'  => 'icon',
    )));
  }


  /**
   *  ADD
   */

  public function add() {
    // register assets
    $this->assets->setHook('js',  pb::load('js',  'components/iframe.min.js'));
    $this->assets->setHook('css', pb::load('css', 'components/iframe.css'));
    $this->assets->setHook('css', pb::load('css', 'elements/drop.css'));

    // register output
    $this->output->setHook('before',   pb::load('html', 'iframe/iframe.php'));
    $this->output->setHook('elements', pb::load('html', 'iframe/btn.php'));
    $this->output->setHook('elements', Helpers::dropdown(array(
      'id'     => 'add',
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => array(
          'child' => array(
              'url'   => pb::purl($this->site->url().'/panel/#/pages/add/'.$this->page->uri()),
              'label' => 'Child',
            ),
          'sibling' => array(
              'url'   => pb::purl($this->site->url().'/panel/#/pages/add/'.$this->page->parent()->uri()),
              'label' => 'Sibling',
            ),
        ),
      'mobile' => 'icon'
    )));
  }


  /**
   *  EDIT
   */

  public function edit() {
    // register assets
    $this->assets->setHook('js',  pb::load('js',  'components/iframe.min.js'));
    $this->assets->setHook('css', pb::load('css', 'components/iframe.css'));
    $this->assets->setHook('css', pb::load('css', 'elements/btn.css'));

    // register output
    $this->output->setHook('before',   pb::load('html', 'iframe/iframe.php'));
    $this->output->setHook('elements', pb::load('html', 'iframe/btn.php'));
    $this->output->setHook('elements', Helpers::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->site->url().'/panel/#/pages/show/'.$this->page->uri(),
      'label'  => 'Edit',
      'mobile' => 'icon',
    )));
  }


  /**
   *  TOGGLE
   */

  public function toggle() {
    // register assets
    $this->assets->setHook('js',  pb::load('js', 'elements/toggle.min.js'));
    $this->assets->setHook('js',  'var currentURI="'.$this->page->uri().'";');
    $this->assets->setHook('js',  'var siteURL="'.$this->site->url().'";');
    $this->assets->setHook('css', pb::load('css', 'elements/btn.css'));

    // register output
    $this->output->setHook('elements', Helpers::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->site->url().'/panel/#/pages/toggle/'.$this->page->uri(),
      'label'  => $this->page->isVisible() ? 'Visible' : 'Invisible',
      'mobile' => 'icon',
    )));
  }


  /**
   *  FILES
   */

  public function files($type = null) {
    // register hooks
    $this->assets->setHook('css', pb::load('css', 'elements/fileviewer.css'));

    // prepare output
    $files = $this->page->files();
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);
    $files = $files->limit(15);

    if ($files->count() > 0) {
      $items = array();
      foreach($files as $file) {
        $args = array(
          'type'      => $file->type(),
          'url'       => $this->site->url().'/panel/#/files/show/'.$this->page->uri().'/'.$file->filename(),
          'label'     => $file->filename(),
          'extension' => $file->extension(),
        );

        if ($file->type() == 'image') $args['image']  = $file->url();
        array_push($items, $args);
      }

      // register output
      $this->output->setHook('elements', Helpers::fileviewer(array(
        'id'     => 'files',
        'icon'   => ($type == 'image') ? 'photo' : 'file',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $items,
        'count'  => count($items),
        'more'   => $this->site->url().'/panel/#/files/index/'.$this->page->uri(),
        'mobile' => 'icon'
      )));
    }
  }


  /**
   *  IMAGES
   */

  public function images() {
    return $this->files('image');
  }


  /**
   *  LANGUAGES
   */

  public function languages() {
    if ($languages = $this->site->languages()) {
      // register assets
      $this->assets->setHook('css', pb::load('css', 'elements/drop.css'));

      // prepare output
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url().'/'.$this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      // register output
      $this->output->setHook('elements', Helpers::dropdown(array(
        'id'     => 'lang',
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      )));
    }
  }


  /**
   *  LOADTIME
   */

  public function loadtime() {
    // register assets
    $this->assets->setHook('css', pb::load('css', 'elements/label.css'));

    // register output
    $this->output->setHook('elements', Helpers::label(array(
      'id'     => 'loadtime',
      'icon'   => 'clock-o',
      'label'  => number_format( ( microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
      'mobile' => 'label',
    )));
  }


  /**
   *  USER
   */

  public function user() {
    // register assets
    $this->assets->setHook('js',  pb::load('js',  'components/iframe.min.js'));
    $this->assets->setHook('css', pb::load('css', 'components/iframe.css'));
    $this->assets->setHook('css', pb::load('css', 'elements/btn.css'));

    // register output
    $this->output->setHook('before',   pb::load('html', 'iframe/iframe.php'));
    $this->output->setHook('elements', pb::load('html', 'iframe/btn.php'));
    $this->output->setHook('elements', Helpers::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->url().'/panel/#/users/edit/'.$this->site->user(),
      'label'  => $this->site->user(),
      'mobile' => 'icon',
      'float'  => 'right',
    )));
  }


  /**
   *  LOGOUT
   */

  public function logout() {
    // register assets
    $this->assets->setHook('css', pb::load('css', 'elements/btn.css'));

    // register output
    $this->output->setHook('elements', Helpers::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->site->url().'/panel/logout',
      'label'  => 'Logout',
      'mobile' => 'icon',
      'float'  => 'right',
    )));
  }

}
