<?php namespace PaperClip\Support\Facades;
use Illuminate\Support\Facades\Facade;

class MessageBag extends Facade {
/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'messageBag'; }
}