<?php namespace PaperClip\Support\Config;

use PaperClip\JellyCollection\JellyCollection;
class Config extends JellyCollection
{
	public function __construct(array $settings)
	{
		$this->items = $settings;
	}
} 