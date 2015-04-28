<?php namespace PaperClip\DonateButtonLocalizer;

use Illuminate\Support\ServiceProvider;

class DonateButtonLocalizerServiceProvider extends ServiceProvider 
{
  public function register()
  {
    $this->app->bindShared('donateButtonLocalizer', function($app)
    {
      return new DonateButtonLocalizer;
    });
  }
}