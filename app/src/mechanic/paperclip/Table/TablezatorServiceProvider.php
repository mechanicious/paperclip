<?php 	namespace PaperClip\Table;
use Illuminate\Support\ServiceProvider;

class TablezatorServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind('tableizer', function()
		{
			return new Tablezator;
		});
	}
}