<?php namespace PaperClip\Tablezator;

use PaperClip\JellyCollection\JellyCollection;

class Column extends JellyCollection
{
	/**
	 * 	Holds members of the collection
	 * @var array
	 */
	protected $items;

	public function __construct(array $rows)
	{
		$this->items = $rows;
	}
}