<?php namespace PaperClip\Support\Contracts;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

abstract class PaperClipModel extends \Eloquent
{
	use SoftDeletingTrait;
}