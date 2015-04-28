<?php namespace PaperClip\EmailSubscriptionLocalizer;

use Illuminate\Support\ServiceProvider;

class EmailSubscriptionLocalizerServiceProvider extends ServiceProvider 
{
  public function register()
  {
    $this->app->bindShared('emailSubscriptionLocalizer', function($app)
    {
      return new EmailSubscriptionLocalizer;
    });
  }
}