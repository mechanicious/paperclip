<?php namespace PaperClip\Tablezator;

use PaperClip\Config\Config; 
use PaperClip\Support\MakeInterface;

class Tablezator implements MakeInterface
{
	/**
	 * Holds the config
	 * @var PaperClip\JellyCollection\JellyCollection;
	 */
	public $config = null;

	public function make(Config $config)
	{
		$this->config = $config;
		return $this->getPaperTable();
	}

	/**
	 * Create new PaperTable instance
	 * @return PaperClip\Tablezator\PaperTable
	 */
	protected function getPaperTable()
	{
		return new PaperTable($this->columnize());
	}
	
	/**
	 * Get array with columns
	 * @return array
	 */
	protected function columnize()
	{
		$columnizer = new Columnizer;
		return $columnizer->make($this->make($this->settings));
	}
}