<?php namespace PaperClip\Tablezator;

use PaperClip\Support\Config\Config; 
use PaperClip\Support\Contracts\MakeInterface;
use Illuminate\Database\Eloquent\Model;
use PaperClip\JellyCollection\JellyCollection;
use PaperClip\Support\Contracts\TablezatorInterface;

class Columnizer implements MakeInterface
{
	public function make(Config $config)
	{
		$this->config = $config;
		return $this->columnize();		
	}

	protected function columnize()
	{
		$modelName = $this->getModelName();
		$model = new $modelName;
		$queryResult = $this->selectQuery($model);
		return $this->buildColumn($model, $queryResult);
	}

	/**
	 * Configure a column
	 * @param  Model  $model
	 * @param  array  $queryResult
	 * @return array
	 */
	protected function buildColumn(TablezatorInterface $model, array $table)
	{
		// mixed array
		$config 	= $model->getConfig();
		$columns 	= $this->splitIntoColumns(new JellyCollection($table)); 
		$column 	= new Column($table);
		dd($column->columnize());
	}

	protected function splitIntoColumns(JellyCollection $table)
	{
		return $table->columnize();
	}

	/**
	 * Get a configuration entry
	 * @param  string $column
	 * @param  string $settingName
	 * @return mixed
	 */
	protected function getColumnSetting(Config $config, $column, $settingName)
	{
		$setting = $config->dotSearch($column . $settingName)->result();
		return $setting;
	}
	/**
	 * Extract model name from the config
	 * @return string
	 */
	protected function getModelName()
	{
		$modelName = $this->config->keySearch('model_name')->result();
		if(is_string($modelName)) return $modelName;
		elseif(is_callable($modelName)) return $modelName();
	}

	/**
	 * Get the query results
	 * @return array
	 */
	protected function selectQuery(Model $model)
	{
		$table = $this->config->recursiveKeySearch('table')->result();
		if(is_array($table)) return $table;
		else
		{
			$selectQuery = $this->config->recursiveSearch('select_query')->result();
			return $entries = $model->query()
			->whereRaw($selectQuery)
			->limit($this
				->config
				->recursiveKeySearch('amount_rows')
				->result())
			->get()
			->toArray();
		}
	}
}