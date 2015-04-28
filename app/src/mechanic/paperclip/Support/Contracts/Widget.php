<?php namespace PaperClip\Support\Contracts;

/**
* This class is responsible for providing the widgets
* a set of convenient methods.
*/
abstract class Widget implements \PaperClip\Support\Contracts\Installable 
{
	/**
	 * Install the widget using the a widget install module
	 * @return boolean
	 */		
	public function install()
	{
		$installer = new \PaperClip\WidgetInstaller\WidgetInstaller;
		return $installer->install($this->settings);
	}

	/**
	 * Uninstall the widget
	 * @return boolean
	 */
	public function uninstall()
	{
		$installer = new \PaperClip\WidgetInstaller\WidgetInstaller;
		return $installer->uninstall($this->settings['strictName']);
	}

	/**
	 * Get the widget model
	 * @return Illuminate\Database\Eloquent\Model | null
	 */
	protected function getModel()
	{
		return \Widget::where('strictName', '=', $this->settings['strictName'])->first();
	}

	/**
	 * Get's the user settings
	 * @param  string $fieldname
	 * @return array | string | null
	 */
	protected function getUserSettings($fieldname = null)
	{
		$serializedSettings = $this->getModel()->userSettings;
		$unserializedSettings = unserialize($serializedSettings);
		if(is_null($fieldname)) return $unserializedSettings;
		return $unserializedSettings[$fieldname];
	}

	/**
	 * This method returns the Widget's attributes dynamically.
	 * @param  string $method
	 * @param  array $args
	 * @return mixed | null
	 */
	public function __get($name)
	{
		return $this->model()->$name;
	}

	/**
	 * This method automatically sets and saves the 
	 * Widget's attributes dynamically.
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function __set($name, $value)
	{
		$validator = new \PaperClip\WidgetAttributeValidator\WidgetAttributeValidator;
		if($validator->forUpdate($name, $value))
		{
			$model = $this->model();
			$model->{$name} = $value;
			$model->save();	
		}
		else
			/**
			 * We will throw an exception because there is not much we can do at this point.
			 * It's up to the widget developer to submit valid data.
			 */
			throw new Exception("The validation failed for set attribute [{$name}] to [{$value}].", 1);
			
	}
}

