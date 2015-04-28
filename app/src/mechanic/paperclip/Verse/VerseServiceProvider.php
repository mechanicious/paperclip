<?php 	namespace PaperClip\Verse;
use Illuminate\Support\ServiceProvider;

class VerseServiceProvider extends ServiceProvider 
{
	public function register()
	{
		$this->app->bind('verse', function($anyString)
		{
			return new Verse;
		});
	}
}