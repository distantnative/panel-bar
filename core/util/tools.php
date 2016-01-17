<?php

namespace panelBar;

use Str;
use Tpl;

class Tools {

  public static function load($type, $file, $array = array()) {
    return tpl::load(self::path($type, $file), $array);
  }

  public static function path($type, $append) {
    $paths = array(
      'css'       => DS . 'assets'    . DS . 'css' . DS . $append . '.css',
      'js'        => DS . 'assets'    . DS . 'js'  . DS . 'dist' . DS . $append . '.min.js',
      'html'      => DS . 'templates' . DS .              $append . '.php',
    );
    return realpath(__DIR__ . '/../..') . $paths[$type];
  }


  public static function fileicon($file) {
    switch($file->type()) {
      case 'archive':
        return 'file-archive-o';
        break;
      case 'code':
        return 'code';
        break;
      case 'audio':
        return 'volume-up';
        break;
      case 'video':
        return 'film';
        break;
      case 'document':
        switch ($file->extension()) {
          case 'pdf':
            return 'file-pdf-o';
            break;
          case 'doc':
          case 'docx':
            return 'file-word-o';
            break;
          case 'xls':
          case 'xlsx':
            return 'file-excel-o';
            break;
          case 'ppt':
          case 'pptx':
            return 'file-powerpoint-o';
            break;
          default:
            return 'file-text-o';
            break;
        }
        break;
      default:
        return 'file-o';
        break;
    }
  }

  public static function fontPaths($css) {
    $base  = panel()->urls()->assets() . '/fonts/';
    $fonts = array(
      'FA.woff2'        => $base . 'fontawesome-webfont.woff2?v=4.4.0',
      'FA.woff'         => $base . 'fontawesome-webfont.woff?v=4.4.0',
      'SSP400.woff2'    => $base . 'sourcesanspro-400.woff2',
      'SSP400.woff'     => $base . 'sourcesanspro-400.woff',
      'SSP600.woff2'    => $base . 'sourcesanspro-600.woff2',
      'SSP600.woff'     => $base . 'sourcesanspro-600.woff',
      'SSPitalic.woff2' => $base . 'sourcesanspro-400-italic.woff2',
      'SSPitalic.woff'  => $base . 'sourcesanspro-400-italic.woff',
    );

    return str::template($css, $fonts);
  }
}
