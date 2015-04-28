<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class User extends PaperClipModel implements UserInterface, RemindableInterface, TablezatorInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function getFirstname()
	{
		return $this->firstname;
	}

	// Tablezator::unforgenize will look for this.
	public function identify()
	{
		return ucwords("$this->firstname $this->lastname"); 
	}
}
