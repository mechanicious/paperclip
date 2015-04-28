<?php namespace ViewHelpers\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Http\Request
 */
class Post extends Facade {
/**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'postvh'; }
}