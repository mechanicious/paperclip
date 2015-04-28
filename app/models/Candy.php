<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Candy extends PaperClipModel implements TablezatorInterface 
{
	protected $fillable = [];

    public function posts()
    {
        return $this->belongsTo("Post");
    }

    // Tablezator::unforgenize will look for this.
	public function identify()
	{
		return $this->name; 
	}

  static public function getCandies($skip = "1", $amount = "1") {
    if(! is_string($skip)) return;
    return DB::table('candies')->skip($skip)->take($amount);
  }
}