<?php

namespace PanelBar;

use Tpl;

use PanelBar\Helpers;

class Elements {

  public $site;
  public $page;

  protected $assets;
  protected $css;
  protected $js;

  public function __construct($assets) {
    $this->site   = site();
    $this->page   = page();

    $this->assets = $assets;
    $this->css  = array(
      'base'       => $this->assets->paths['css'],
      'components' => $this->assets->paths['css'] . 'components' . DS,
      'elements'   => $this->assets->paths['css'] . 'elements'   . DS,
    );
    $this->js  = array(
      'base'       => $this->assets->paths['js'],
    );
  }

  public function panel() {
    // return output
    return Helpers::link(array(
      'id'      => 'panel',
      'icon'    => 'cogs',
      'url'     => site()->url().'/panel',
      'label'   => 'Panel',
      'mobile'  => 'icon',
    ));
  }

  public function add() {
    // register hooks
    $this->assets->setHook('js',  tpl::load($this->js['base'] . 'iframe.min.js'));
    $this->assets->setHook('css', tpl::load($this->css['components'] . 'iframe.css'));
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'drop.css'));

    // return output
    return Helpers::dropdown(array(
      'id'     => 'add',
      'icon'   => 'plus',
      'label'  => 'Add',
      'items'  => array(
          'child' => array(
              'url'   => $this->site->url().'/panel/#/pages/add/'.$this->page->uri(),
              'label' => 'Child',
            ),
          'sibling' => array(
              'url'   => $this->site->url().'/panel/#/pages/add/'.$this->page->parent()->uri(),
              'label' => 'Sibling',
            ),
        ),
      'mobile' => 'icon'
    ));
  }

  public function edit() {
    // register hooks
    $this->assets->setHook('js',  tpl::load($this->js['base'] . 'iframe.min.js'));
    $this->assets->setHook('css', tpl::load($this->css['components'] . 'iframe.css'));
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'btn.css'));

    // return output
    return Helpers::link(array(
      'id'     => 'edit',
      'icon'   => 'pencil',
      'url'    => $this->site->url().'/panel/#/pages/show/'.$this->page->uri(),
      'label'  => 'Edit',
      'mobile' => 'icon',
    ));
  }

  public function toggle() {
    // register hooks
    $this->assets->setHook('js',  tpl::load($this->js['base'] . 'iframe.min.js'));
    $this->assets->setHook('css', tpl::load($this->css['components'] . 'iframe.css'));
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'btn.css'));

    // return output
    return Helpers::link(array(
      'id'     => 'toggle',
      'icon'   => $this->page->isVisible() ? 'toggle-on' : 'toggle-off',
      'url'    => $this->site->url().'/panel/#/pages/toggle/'.$this->page->uri(),
      'label'  => $this->page->isVisible() ? 'Visible' : 'Invisible',
      'mobile' => 'icon',
    ));
  }

  public function files($type = null) {
    // register hooks
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'fileviewer.css'));

    // prepare output
    $files  = $this->page->files();
    if (!is_null($type)) $files = $files->filterBy('type', '==', $type);
    $more   = $files->count() > 15;
    $files  = $files->limit(15);

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

      // return output
      return Helpers::fileviewer(array(
        'id'     => 'files',
        'icon'   => ($type == 'image') ? 'photo' : 'file',
        'label'  => ($type == 'image') ? 'Images' : 'Files',
        'items'  => $items,
        'count'  => count($items),
        'more'   => $more ? $this->site->url().'/panel/#/files/index/'.$this->page->uri() : false,
        'mobile' => 'icon'
      ));
    }
  }

  public function images() {
    // return output
    return $this->files('image');
  }

  public function languages() {
    if ($languages = $this->site->languages()) {
      // register hooks
      $this->assets->setHook('css', tpl::load($this->css['elements'] . 'drop.css'));

      // prepare output
      $items = array();
      foreach($languages->not($this->site->language()->code()) as $language) {
        array_push($items, array(
          'url'   => $language->url().'/'.$this->page->uri(),
          'label' => strtoupper($language->code())
        ));
      }

      // return output
      return Helpers::dropdown(array(
        'id'     => 'lang',
        'icon'   => 'flag',
        'label'  => strtoupper($this->site->language()->code()),
        'items'  => $items,
        'mobile' => 'label'
      ));
    }
  }

  public function loadtime() {
    // register hooks
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'label.css'));


    // return output
    return Helpers::label(array(
      'id'     => 'loadtime',
      'icon'   => 'clock-o',
      'label'  => number_format( ( microtime( true ) - $_SERVER['REQUEST_TIME_FLOAT'] ), 2 ),
      'mobile' => 'label',
    ));
  }

  public function logout() {
    // register hooks
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'btn.css'));

    // return output
    return Helpers::link(array(
      'id'     => 'logout',
      'icon'   => 'power-off',
      'url'    => $this->site->url().'/panel/logout',
      'label'  => 'Logout',
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

  public function user() {
    // register hooks
    $this->assets->setHook('css', tpl::load($this->css['elements'] . 'btn.css'));

    // return output
    return Helpers::link(array(
      'id'     => 'user',
      'icon'   => 'user',
      'url'    => $this->site->url().'/panel/#/users/edit/'.$this->site->user(),
      'label'  => $this->site->user(),
      'mobile' => 'icon',
      'float'  => 'right',
    ));
  }

}
