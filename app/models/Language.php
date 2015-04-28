<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Language extends PaperClipModel implements TablezatorInterface 
{
	public function user()
  {
    return $this->belongsTo('User');
  }

  public function categories()
  {
  	return $this->hasMany('Category');
  }

    // Tablezator::unforgenize will look for this.
	public function identify()
	{
		return $this->language; 
	}

  /**
   * Get a language with a certain abbreviation 
   * @param  string $abbr
   * @return Language | null
   */
  public static function withAbbr($abbr) {
    return \Language::whereNull('deleted_at')->where('abbreviation', '=', $abbr)->first();
  }

  public static function withName($name) {
    return \Language::where('deleted_at', '=', null)->where('language', '=', $name);
  }

  public static function withId($id) {
    return \Language::whereNull('deleted_at')->where('od', '=', $id); 
  }
}
