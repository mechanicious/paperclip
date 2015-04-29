<?php

class LocaleSetupFilter
{
  protected $requestedLangAbbr;
  protected $fallbackLangAbbr;

  public function __construct() 
  {
    $this->requestedLangAbbr  = \Route::current()->getParameter('lang');
  }

  public function filter()
  {
    if( $this->setupRequestedLang() === false 
      && $this->setupFallbackLocale() === false)
    {
      return $this->terminate();
    }
  }

  /**
   * Puts the lang info into the cache.
   */
  protected function setupLocaleCache($lang)
  {
    $language = $lang; // No queries being wasted
    if(is_null($language)) return false;
    \Lang::setLocale($this->requestedLangAbbr);
    if(\Cache::get('locale.abbr') !== $this->requestedLangAbbr)
    {
      \Cache::forever('locale.language', $language);
      \Cache::forever('locale.abbr', $this->requestedLangAbbr);
    }
  }

  /**
   * Sets-up the fallback language.
   */
  protected function setupFallbackLocale() 
  {
    $defaultLang = \Language::withAbbr($this->fallbackLangAbbr);
    if( ! is_null($defaultLang))
    {
      Lang::setLocale($this->fallbackLangAbbr);
      $this->setupLocaleCache($defaultLang);
      return \Redirect::route('error.404.general');
    } return false; 
  }

  /**
   * Sets-up the language specified in the URL.
   */
  protected function setupRequestedLang() 
  {
    $requestedLang = \Language::withAbbr($this->requestedLangAbbr);
    if( ! is_null($requestedLang)) 
    {
      \Lang::setLocale($this->requestedLangAbbr);
      return $this->setupLocaleCache($requestedLang);
    } return false;
  }

  /**
   * Handles the situation of no languages being available.
   */
  protected function terminate() 
  {
    $reqlang = $this->requestedLangAbbr;
    $deflang = \Lang::getLocale();
    $dasbhlink = \HTML::linkRoute('admin.home', \Lang::trans('adminItems.dashboard'));
    // TODO: Installation views could be made to provide the 
    // user with some nice errors and shortcuts to handle
    // the problem...
    return \Response::make("Both the requested language '{$reqlang}' and the default language '{$deflang}' are not available. You can change the default language in the {$dasbhlink}.", 500);
  }
}