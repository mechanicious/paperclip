<?php namespace PaperClip\Notifier;

use Illuminate\Support\ServiceProvider;

class NotifierServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bindShared('notifier', function($app)
		{
			return new Notifier($app['session']);
		});
	}
}