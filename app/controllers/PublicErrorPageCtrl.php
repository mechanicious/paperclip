<?php

class PublicErrorPageCtrl extends \BaseController {
  protected $layout = 'theme.eline._errorPageLayout';

  public function __construct() {
    View::share('langAbbr', Lang::getFallback());
  }

  public function notFound() 
  {
    $this->layout->content = View::make('theme.eline.404.index');
    return $this->layout->render();
  }
}