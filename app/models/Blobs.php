<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Blob extends PaperClipModel 
{
	protected $fillable = [];
	protected $table = 'blobs';
}