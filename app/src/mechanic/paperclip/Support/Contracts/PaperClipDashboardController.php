<?php namespace PaperClip\Support\Contracts;

abstract class PaperClipDashboardController extends \Controller
{
	/**
	 * Get the classname
	 * @return string
	 */
	protected function classname()
	{
		return strtolower(get_called_class());
	}

	/**
	 * Name of the model
	 * @return string
	 */
	protected function modelname()
	{
		$modelName = '\\' . $this->title();
		return $modelName;
	}

	/**
	 * Lowercase title of the controller
	 * @return string
	 */
	protected function ltitle()
	{
		return strtolower($this->title());
	}

	/**
	 * Title of a controller is the string between:
	 * Dashboard & Controller.php
	 * @return string
	 */
	protected function title()
	{
		$classname = $this->classname();
		$title = ucfirst(str_replace(array(
			'dashboard', 
			'controller'), "", $classname));
		return $title;
	}

	protected function localeTitle()
	{
		$title = $this->title();
		return $localeTitle = \Lang::get('adminItems.' . lcfirst($title));
	}

	/**
	 * Name of the view is: domain.controllerTitle.index
	 * @param  string $domain
	 * @return string
	 */
	protected function viewName($domain)
	{
		$title = $this->title();
		$elements = array($domain, $title, "index");
		$viewName = implode(".", $elements);

		return $viewName;
	}

	protected function setupLayout()
	{	
		$viewName 	 = $this->viewName($this->domain);
		$title = $this->title();
		$localeTitle = $this->localeTitle();
			// Pass this to the view. It will be extracted.
	        $data = array(
	            'title' => ucfirst($title),
	            'localeTitle' => ucfirst($localeTitle),
	        );

	        return \View::make(strtolower($viewName), $data);
	}
}