<?php

namespace PanelBar;

use PanelBar\PB;
use PanelBar\Build;

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
    return Build::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => pb::url(''),
      'label'   => 'Panel',
      'mobile'  => 'icon',
    ));
  }


  /**
   *  ADD
   */

  public function add() {
    $this->_registerIframe();

    return Build::dropdown(array(
      'id'     => 'add',
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => array(
          'child' => array(
              'url'   => pb::url('add', $this->page),
              'label' => 'Child',
            ),
          'sibling' => array(
              'url'   => pb::url('add', $this->page->parent()),
              'label' => 'Sibling',
            ),
        ),
      'mobile' => 'icon'
    ));
  }


  /**
   *  EDIT
   */

  public function edit() {
    $this->_registerIframe();

    return Build::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => pb::url('show', $this->page),
      'label'  => 'Edit',
      'mobile' => 'icon',
    ));
  }


  /**
   *  TOGGLE
   */

  public function toggle() {
    // register assets
    $this->assets->setHook('css', pb::load('css', 'elements/toggle.css'));

    if(!pb::version("2.2.0")) {
      $js = 'currentURI="'.$this->page->uri().'";siteURL="'.$this->site->url().'";';
      $this->assets->setHook('js',  pb::load('js', 'elements/toggle.min.js'));
      $this->assets->setHook('js',  $js);
    } else {
      $this->_registerIframe();
      $this->assets->setHook('js',  'panelbarIframe.init([".panelbar--toggle a"]);');
    }


    if($this->page->isInvisible() and !pb::version("2.2.0")) {
      // prepare output
      $siblings = array();
      array_push($siblings, array(
        'url'   => pb::url('toggle', $this->page),
        'label' => '&rarr;<span class="gap"></span>&larr;'
      ));
      foreach ($this->page->siblings()->visible() as $sibling) {
        array_push($siblings, array('label' => $sibling->title()));
        array_push($siblings, array(
          'url'   => pb::url('toggle', $this->page),
          'label' => '&rarr;<span class="gap"></span>&larr;'
        ));
      }

      return Build::dropdown(array(
        'id'     => 'toggle',
        'icon'   => 'toggle-off',
        'label'  => 'Invisible',
        'items'  => $siblings,
        'mobile' => 'icon',
      ));

    } else {
      return Build::link(array(
        'id'     => 'toggle',
        'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
        'label'  => $this->page->isVisible() ? 'Visible' : 'Invisible',
        'url'    => pb::url('toggle', $this->page),
        'mobile' => 'icon',
      ));
    }
  }


  /**
   *  FILES
   */

  public function files($type = null) {
     // prepare output
    $files = $this->page->files();
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);
    $files = $files->limit(15);

    if ($files->count() > 0) {
      $items = array();
      foreach($files as $file) {
        $args = array(
          'type'      => $file->type(),
          'url'       => pb::url('show', $file),
          'label'     => $file->filename(),
          'extension' => $file->extension(),
        );

        if ($file->type() == 'image') $args['image']  = $file->url();
        array_push($items, $args);
      }

      return Build::fileviewer(array(
        'id'     => 'files',
        'icon'   => ($type == 'image') ? 'photo' : 'file',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $items,
        'count'  => count($items),
        'all'    => pb::url('index', $file),
        'mobile' => 'icon'
      ));
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
      // prepare output
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url() . '/' . $this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      // register output
      return Build::dropdown(array(
        'id'     => 'lang',
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      ));
    }
  }


  /**
   *  LOADTIME
   */

  public function loadtime() {
    return Build::label(array(
      'id'     => 'loadtime',
      'icon'   => 'clock-o',
      'label'  => number_format((microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
      'mobile' => 'label',
    ));
  }


  /**
   *  USER
   */

  public function user() {
    $this->_registerIframe();

    return Build::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => pb::url('edit', $this->site->user()),
      'label'  => $this->site->user(),
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }


  /**
   *  LOGOUT
   */

  public function logout() {
    return Build::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => pb::url('logout'),
      'label'  => 'Logout',
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }


  /**
   *  TOOL: iFrame
   */

  protected function _registerIframe() {
    // register assets
    $this->assets->setHook('js',  pb::load('js',  'components/iframe.min.js'));
    $this->assets->setHook('css', pb::load('css', 'components/iframe.css'));

    // register output
    $this->output->setHook('before',   pb::load('html', 'iframe/iframe.php'));
    $this->output->setHook('elements', pb::load('html', 'iframe/btn.php'));
  }

}
