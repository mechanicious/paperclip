<?php 

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Widget extends \Eloquent
{
	use SoftDeletingTrait;

	protected $fillable = array('title', 
		'strictName', 
		'userSettings', 
		'description', 
		'bodyTemplateName', 
		'user_id',
		'previousVersion',
		'currentVersion',); 

	/**
	 * Get the user which installed the widget
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}
}