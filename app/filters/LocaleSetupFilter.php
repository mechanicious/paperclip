<?php

class LocaleSetupFilter
{
  protected $requestedLangAbbr;
  protected $fallbackLangAbbr;

  public function __construct() 
  {
    $this->requestedLangAbbr  = \Route::current()->getParameter('lang');
    $this->fallbackLangAbbr = \Lang::getFallback();
  }

  public function filter()
  {
    $requestedLang = \Language::withAbbr($this->requestedLangAbbr);
    if( ! is_null($requestedLang)) 
    {
      \Lang::setLocale($this->requestedLangAbbr);
      return $this->setupLocaleCache($requestedLang);
    }
    
    $defaultLang = \Language::withAbbr($this->fallbackLangAbbr);
    if( ! is_null($defaultLang))
    {
      Lang::setLocale($this->fallbackLangAbbr);
      $this->setupLocaleCache($defaultLang);
      return \Redirect::route('error.404.general');
    }

    return \Response::make("No default language({$this->fallbackLangAbbr}) available in the database.", 500);
  }

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
}