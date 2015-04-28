<?php namespace PaperClip\Support\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Http\Request
 */
class DonateButtonLocalizer extends Facade {
/**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'donateButtonLocalizer'; }
}