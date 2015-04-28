<?php namespace PaperClip\WidgetAttributeValidator;

class WidgetAttributeValidator
{
	protected function validate($name, $value, $type = null)
	{
		// We need to nicely separate the words with a dot
		$regulation = array('widget');
		if(!is_null($type)) array_push($regulation, $type);
		array_push($regulation, $name);
		$regulation = implode(".", $regulation);

		$validator = \Validator::make(
			array($name => $value), 
			array($name => \Government::regulation($regulation)));
		if($validator->fails) return false;
		return true;
	}
	/**
	 * Validate an atribute with the Government
	 * @param  srtring $name
	 * @param  array $value
	 * @return boolean
	 */
	public function forUpdate($name, $value)
	{
		$this->validate($name, $value, "update");
	}
}