<?php namespace PaperClip\Support\Validation;

use Illuminate\Support\ServiceProvider;

class GovernmentServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bindShared('government', function($app)
		{
			return new Government();
		});
	}
}