<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Page extends PaperClipModel implements TablezatorInterface 
{
	public function languages()
	{
		return $this->belongsTo('Language');
	}

	public function identify()
	{
		return $this->name; 
	}
}