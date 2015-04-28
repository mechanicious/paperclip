<?php 	namespace PaperClip\MessageBag;
use Illuminate\Support\ServiceProvider;

class MessageBagServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind('messageBag', function()
		{
			return new \Illuminate\Support\MessageBag;
		});
	}
}