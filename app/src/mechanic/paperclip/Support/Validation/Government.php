<?php namespace PaperClip\Support\Validation;

class Government 
{
	public function regulation($item, $extra = array(), $delimiter = ",")
	{
		$regulations = include __DIR__ ."/Regulations.php";
		$extra = implode($delimiter, $extra);
		
		return $regulations[$item] . ($extra ? ",".$extra : "");
	}

	public function validator($name)
	{
		$validators = include __DIR__ ."/Validators.php";
		return isset($validators[$name]) ? $validators[$name] : null; 
	}
}