<?php namespace PaperClip\Support\Contracts;

use PaperClip\Support\Config\Config;

interface MakeInterface
{
	public function make(Config $settings);
}