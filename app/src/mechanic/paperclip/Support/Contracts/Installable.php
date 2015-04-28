<?php namespace PaperClip\Support\Contracts;

interface Installable
{
	/**
	 * Installs entity
	 * @return void
	 */
	public function install();

	/**
	 * Uninstalls entity
	 * @return void
	 */
	public function uninstall();
} 