<?php namespace ViewHelpers;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider 
{
  public function register()
  {
    $this->app->bind('postvh', function()
    {
      return new Post;
    });
  }
}