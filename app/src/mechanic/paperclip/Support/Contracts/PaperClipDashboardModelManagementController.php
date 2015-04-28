<?php namespace PaperClip\Support\Contracts;

abstract class PaperClipDashboardModelManagementController extends PaperClipDashboardController
{
	/**
	 * Check if an entry is restorable
	 * @param  array $columns
	 * @return boolean | int
	 */
	protected function restorable($columns)
	{
		$modelName = '\\' . $this->title();
		foreach ($columns as $column => $value)
		{
			$result = $modelName::where($column, '=', $value)->get();
			// Check if there is a hit
			$result = isset($result[0]) ? $result[0] : null; 
			// If there is a hit and is soft-deleted
			$model 	= $result && !is_null($result->deleted_at) ? $result : null;
			if($model)
			{
				if(isset($model) && $model instanceof $modelName)
					return $model->id;
			}
		}
		return false;
	}

	/**
	 * Gets input
	 * @param  array $inputNames
	 * @return array
	 */
	protected function getInput($inputNames)
	{
		$inputs = array();
		foreach($inputNames as $input)
		{
			if(!is_array($input))
			{
				$inputs[$input] = \Input::get($input);
			}
			else
			{
				foreach ($input as $name)
					dd($name);
			}
		}
		return $inputs;
	}

	/**
	 * Gets regulations
	 * @param  array $inputNames
	 * @return array
	 */
	protected function getRegulations($inputNames)
	{
		$regulations = array();
		foreach($inputNames as $name)
		{
			$regulations[$name] = \Government::regulation(lcfirst($this->title()) . '.' . $name);
		}
		return $regulations;
	}

	/**
	 * Builds an array which contains fields which can trigger restoration
	 * @return array
	 */
	protected function getRestorationTriggers($inputNames)
	{	
		return $this->getInput($inputNames);
	}

	/**
	 * Gets the values of properties of a model
	 * @param  string $modelName
	 * @param  array $properties
	 * @return array
	 */
	protected function getModelPropValues($modelname, $id, $properties, $idInclude = false)
	{
		// Here you need \ 
		$model  = $modelname::find($id);  
		$values = array();
		foreach($properties as $name)
			$values[$name] = $model->$name;
		if($idInclude)
			$values = array_merge($values, array('id' => $id));

		return $values;
	}

	/**
	 * Creates the validator
	 * @param  [type] $inputNames
	 * @return [type]
	 */
	protected function makeValidator($inputNames, $domain = "", $id = null, $unique = array())
	{
		$fields = $inputNames;
		// Some validation rules have a domain, for example "update"
		$domain = $domain ? "." . $domain: $domain;
		$rules 	= array(); 
		// Sometimes id will be appended to the fields and $inputNames will not be
		// equal to $fields anymore. That's why can't relay on $inputNames. Otherwise
		// we could.
		$regulatory = array_values($fields);
		foreach($regulatory as $name)
		{
			if(!is_array($name))
			{
				$fields[$name]	= \Input::get($name);
				$rules[$name] 	= \Government::regulation(lcfirst($this->title()).$domain.'.'.$name
					// You can pass extra arguments in the array to Government::regulation.
					// If it'll be an empty array it will be ignored. Otherwise it will be appended
					// to the regulation.
					, ($id && in_array($name, $unique) ? array($id) : array()));
			}
			else
			{
				$input = \Input::get($name);
				dd($input);
			}
		}
		
		// Sometimes we need to validate id, for example when updating
		// an entry, to see if the entry exists. We want to put this line here
		// to omit the foreach, because input.id doesn't exist, we get it from the url.
		$fields = !is_null($id) ? array_merge($fields, array('id' => $id)) : $fields;

		return $validator = \Validator::make($fields, $rules);	
	}

	/**
	 * This is a method template
	 * @param  array $inputNames
	 * @param  array $restorationTriggers
	 * @return Response
	 */
	public function storeStub($inputNames, $restorationTriggers)
	{
		$validator = $this->makeValidator($inputNames);
		$restorationTriggers = $this->getRestorationTriggers($restorationTriggers);
		if($validator->fails())
		{
			// Check if we can restore the entry
			if($index = $this->restorable($restorationTriggers))
			{
				$this->restore($index);
				\Notifier::putInfo(\Lang::get('admin.item-restored-exisitng', 
					array('item' => \Lang::get('adminItems.' . $this->ltitle()))));

				return \Redirect::route('admin.dashboard.' . $this->ltitle());
			}
			else
			{
				\Notifier::putError($validator);
				return \Redirect::route('admin.dashboard.'  . $this->ltitle());
			}
		}

		$modelName = '\\' . $this->title();
		$item = new $modelName;
		// Triggers happen to be the input fields user fills in.
		// The input fields are named the same the database columns
		// are named. It's a requirement.
		foreach($inputNames as $name)
			$item->$name = \Input::get($name);
		$item->user_id 	= \Auth::id();
		$item->save();

		\Notifier::putSuccess(\Lang::get('admin.item-added', array('item' => \Lang::get('adminItems.'  . $this->ltitle()))));

		return \Redirect::route('admin.dashboard.'  . $this->ltitle());
	}

	protected function editStub($id, $inputNames)
	{
		$validator = \Validator::make(
			array(
				'id' => $id
				),
			array(
				'id' => \Government::regulation($this->ltitle() . '.id')
				));

		if($validator->fails())
		{
			\Notifier::putError($validator);
			return \Redirect::route('admin.dashboard.' . $this->ltitle());
		}

		$modelname = $this->modelname();
		$item = $modelname::find($id);	

		return \Redirect::route('admin.dashboard.' . $this->ltitle())
		// Althrough the model has more properties, we get only the ones
		// we can fill the input fields with.
		->with('input', $this->getModelPropValues($this->modelname(), $id, $inputNames, true));
	}

	public function updateStub($id, $inputNames, $restorationTriggers, $unique)
	{
		// TODO: Implement $unqiue to makeValidator. Which entires should have
		// appended $id, so that they are omited in the unique validation?

		// Validation of a new entry, and an entry to update
		// differs a little.
		$validatoryDomain = "update";
		// the problem is that the currect makevalidtor appends id, if id is given, to every
		// rule but it's not proper because e.g. description doesn't needs it
		$validator = $this->makeValidator($inputNames, $validatoryDomain, $id, $unique);
		$restorationTriggers = $this->getRestorationTriggers($restorationTriggers);
		if($validator->fails())
		{
			// Check if we can restore the entry
			if($index = $this->restorable($restorationTriggers))
			{
				$this->restore($index);
				\Notifier::putInfo(\Lang::get('admin.item-restored-exisitng', array('item' => \Lang::get('adminItems.' .   $this->ltitle()))));
				return \Redirect::route('admin.dashboard.' . $this->ltitle());
			}
			else
			{
				\Notifier::putError($validator);
				return \Redirect::route('admin.dashboard.' . $this->ltitle(), $id)
				->with('input', $this->getModelPropValues($this->modelname(), $id, $inputNames, true));
			}
		}

		$modelname = $this->modelname();
		$item = $modelname::find($id);
		// The input fields are named the same the database columns
		// are named. It's a requirement.
		foreach($inputNames as $name)
			$item->$name = \Input::get($name);
		$item->save();

		\Notifier::putSuccess(\Lang::get('admin.item-updated', array('item' => \Lang::get('adminItems.' . $this->ltitle()))));
		return \Redirect::route('admin.dashboard.' . $this->ltitle());
	}

	/**
	 * This is a method template
	 * @param  numeric $id
	 * @return array
	 */
	public function restoreStub($id)
	{
		$validator = \Validator::make(
			array(
				'id' => $id
				),
			array(
				'id' => \Government::regulation($this->ltitle() . '.id')
				));

		if($validator->fails())
		{
			\Notifier::putError($validator);
			return \Redirect::route('admin.dashboard.' . $this->ltitle());
		}

		$modelname = $this->modelname();
		$item = $modelname::find($id);
		$item->restore();

		\Notifier::putSuccess(\Lang::get('admin.item-restored', array('item' => \Lang::get('adminItems.'  . $this->ltitle()))));
		return \Redirect::route('admin.dashboard.'  . $this->ltitle());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dashboardlanguage/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyStub($id)
	{
		$validator = \Validator::make(
			array(
				'id' => $id
				),
			array(
				'id' => \Government::regulation($this->ltitle() . '.id')
				));

		if($validator->fails())
		{
			\Notifier::putError($validator);
			return \Redirect::route('admin.dashboard.' . $this->ltitle());
		}
		
		// Delete the item!
		$modelname = $this->modelname();
		$modelname::destroy($id);
		
		\Notifier::putSuccess(\Lang::get('admin.item-removed', array('item' => \Lang::get('adminItems.'  . $this->ltitle()))));
		\Notifier::putInfo(\Lang::get('admin.item-restore', array('link' => route('admin.dashboard.'.$this->ltitle().'.restore', $id))));
		return \Redirect::route('admin.dashboard.'.  $this->ltitle());
	}
}