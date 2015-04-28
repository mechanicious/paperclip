<?php namespace PaperClip\Support\Contracts;

interface TablezatorInterface
{
	/**
	 * Resolution of a forgein key.
	 * @return string
	 */
	public function identify();

	
} 