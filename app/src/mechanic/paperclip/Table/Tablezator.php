<?php namespace PaperClip\Table;

use PaperClip\Table\Columnizer;
use Jacopo\Bootstrap3Table\BootstrapTable;
use Illuminate\Support\Contracts\ArrayableInterface;


/**
 * This class automates the generation of tables
 * for views.
 * 
 * @author Mateusz Zawartka
 * @version ALPHA
 */
class Tablezator implements \Countable
{
	private $columnList = array();

	public function init($arrayable)
	{
		$this->columnizePrepared($this->prepareArrayable($arrayable));
		return $this;
	}

	/**
	 * Coverts an instace of Arrayable int an array.
	 * @param  Arrayable $arrayable
	 * @return array
	 */
	private function prepareArrayable($arrayable)
	{
		if($arrayable instanceof ArrayableInterface)
			$prepared = $arrayable->toArray();
		return isset($prepared['data']) ? $prepared['data'] : $prepared; 
	}	
	
	/**
	 * Creates columns out of a prepared Arrayable.
	 * @param  array $preapred
	 * @return void
	 */
	private function columnizePrepared($prepared)
	{
		$columnizer = new Columnizer;
		$this->columnList = array_merge(array_values($columnizer->make($prepared)));
	}
	
	/**
	 * Retuns all columns.
	 * @return array
	 */
	private function getColumns()
	{
		return $this->columnList;
	}
	
	/**
	 * Returns name of each column.
	 * @return array
	 */
	private function getColumnNames()
	{
		$names 		= array();
		$columns 	= $this->columnList;
		if(!empty($columns))
		{
			foreach($columns as $column)
				array_push($names, $column->getName());
		}

		return $names;
	}

	/**
	 * Adds a column to the table.
	 * @param  string $name
	 * @return PaperClip\Table\Column
	 */
	private function putColumn($name)
	{
		$column = new Column($name);
		array_push($this->columnList, $column);
		return end($this->columnList);
	}

	/**
	 * Renames columns.
	 * @param  array $array
	 * @return void
	 */
	private function renameColumns($array)
	{
		$names = $this->getColumnNames();
		$columns = $this->columnList;
		foreach ($array as $name => $newName)
			foreach ($columns as $column)
				if($column->getName() == $name)
					$column->rename($newName);

	}

	/**
	 * Checks if there are rows avaiable.
	 * @return boolean
	 */
	private function hasRows()
	{
		$columns = $this->columnList;
		if($columns)
		{
			foreach($columns as $column)
				if($column->count() )
					return true;
				else
					return false;
		
		}
		return false;
	}	

	/**
	 * Transfroms names into alphanumerical capitalized words.
	 * @return void
	 */
	private function normalizeNames()
	{
		$names = $this->getColumnNames();
		$rename = array();
		foreach ($names as $key)
			// replace non alphanumerical characters with a withespace
			//  and capitalize first letters
			$rename[$key] = ucwords(preg_replace('/[^a-zA-Z0-9]/', " ", $key));

		$this->renameColumns($rename);

		return $this;
	}	

	/**
	 * Searches for a column by name.
	 * @param  int|string $name
	 * @return Column
	 */
	public function find($name, $index = false)
	{
		$columns = $this->columnList;
		$counter = 0;
		foreach ($columns as &$column)
		{
			if(strtolower($column->getName()) == strtolower($name))
				return $index === false ? $column : $counter;
			$counter++;
		}
		
		return;
	}
	
	/**
	 * Counts the number of columns.
	 * @return int
	 */
	public function count()
	{
		return count($this->columnList);
	}

	/**
	 * Counts the number of rows in a column.
	 * @param  int|string $name
	 * @return int
	 */
	public function countRows($name)
	{
		$column = $this->find($name);
		if($column)
			return $column->count();
		return;
	}

	/**
	 * Returns joined rows. Columns are emptied.
	 * @return array
	 */
	public function getRows()
	{
		$rows = array();
		while($this->hasRows())
		{
			$row = array();
			foreach($this->columnList as $column)
			{
				array_push($row, $column->pull());
			}
			array_push($rows, $row);
		}
		return $rows;
	}

	/**
	 * Fills the column with a certain value;
	 * @param  int|string 			$columnName
	 * @param  int|string|callable 	$valueOrCallback
	 * @return Tablezator
	 */
	public function fill($columnName, $valueOrCallback = null)
	{
		$column = $this->find($columnName);
		if($column)
		{
			$length = reset($this->columnList)->count();
			for($i = 0; $i < $length; $i++)
				// We'll pass the counter and column, so you can make
				// a row from those two.
				if(is_callable($valueOrCallback))
				{
					$column->put($valueOrCallback($i, $column));
				}
				else
				{
					$column->put($valueOrCallback);
				}
		}
		return $this;
	}

	/**
	 * Removes a column by name.
	 * @param  int|strign $name
	 * @return Tablezator
	 */
	public function remove($name)
	{
		$index = $this->find($name, true);
		unset($this->columnList[$index]);
		array_values($this->columnList);
		return $this;
	}

	/**
	 * Execute a function over each column.
	 * @param  callback $callback
	 * @return \Paperclip\Table\Tablezator
	 */
	public function each($callback)
	{
		array_walk($this->columnList, $callback);
		return $this;
	}

	/**
	 * Use this filter to translate forgein key references into values.
	 * Works only with Eloquent ORM.
	 * @return \PaperClip\Table\Tablezator
	 */
	public function unforgenize()
	{
		$this->each(function($column)
		{
			// That's how forgein keys are defined for Eloquent.
			$forgeinSingular = strtolower(str_replace("_id", "", $column->getName()));
			// ake sure the namespace is global.
			$modelName = '\\' . ucfirst($forgeinSingular);
			// The column name has a corresponding model
			// (= all forgein keys correspond to a table
			// and each table has a model.)
			if(class_exists($modelName)
				// We assume the model uses Eloquent ORM.
				&& method_exists($modelName, 'find')
				// instance should be albe to indentify themselfs
				&& method_exists($modelName, 'identify'))
			{	
				// A forgein key should be numeric, otherwise
				// why to translate it?
				foreach ($column->rows() as &$row)
						if(is_numeric($row))
						{
							// We instantiate the entity so we can play
							// with Eloquent.
							$model = $modelName::find((int)$row);
							if($model)
							{
								$row = $model->identify();
								// Now we don't display an id anymore but a name.
								// We don't uppercase the name, see Tablezator::normalize
								$column->rename($forgeinSingular);
							}		
						}
			}
		});

		return $this;
	}

	/**
	 * Use this filter to break the content of rows into
	 * multiple lines. Optionally specify your own linebreak AND column name.
	 * @param  int $length
	 * @param  string $lineBreak
	 * @return \PaperClip\Table\Tablezator
	 */
	public function breakLinesAfter($length, $name = null, $lineBreak = "\n")
	{
		$columns = $this->columnList;
		if(!empty($columns))
		{	
			foreach ($columns as $column)
			{
				// just get rows and check if you can applly the filter
				if($rows = $column->rows())
				{
					foreach ($rows as &$row)
					{
						if(strlen($row) > $length)
						{
							// if column name is set then the column name
							// must match. 
							if(!is_null($name))
							{
								// SQL Column names declarations are case insensitive, 
								// so we can comfort the user a little bit too.
								if(strtolower($column->getName()) === strtolower($name))
								{
									$row = wordwrap($row, $length, $lineBreak);
									// we need to call the class and reapply the rows
									// otherwise the changes won't apply
									$column->rows($rows);
								}
								
							}
							else
							{
								$row = wordwrap($row, $length, $lineBreak);
								$column->rows($rows);
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Returs html for the table. Note the structure of this
	 * will change. It will be split up in more methods.
	 * @return string
	 */
	public function make($arrayable, $editUrl, $removeUrl)
	{
		$this->init($arrayable);
		$bstable = new BootstrapTable;
		$bstable->setConfig(array("table-hover"=>false, "table-condensed"=>true, "table-striped"=>true ) );
		
		$colName = \Lang::get('adminItems.action');
		$this->putColumn($colName);
		
		$this->fill($colName, function($i, $column) use($editUrl, $removeUrl){
			// Generate for each row a edit/delete button
			// based on the row's ID.
			$columnWithIds = $this->find("id");
			if($columnWithIds)
				$ids = $columnWithIds->rows();
			$id = $ids[$i];

			$editUrl = substr($editUrl, 0, strrpos($removeUrl, "/")-1) .  $id;
			$removeUrl = substr($removeUrl, 0, strrpos($removeUrl, "/")+1) .  $id;

			// class="hsd0f8" is used to not escape special chars.
			return strtolower('<a class="btn btn-primary hsd0f8" href="'. " $editUrl " .'"><i class="icon-edit"></i></a> '
			.   ' <a class="btn btn-danger hsd0f8" href="'. "$removeUrl" .'"><i class="icon-remove"></i></a>');
		});
		
		// let's apply some filters
		$this->remove('deleted_at')->remove('id')
		->unforgenize()
		->normalizeNames()
		->breakLinesAfter(20, "description", "<br/>");
		$names = $this->getColumnNames();	
		$bstable->setHeader($names);

		// build rows
		$rows = $this->getRows();
		foreach ($rows as $row)
			$bstable->addRows(array_map(function($v) {
				if(strpos($v, 'hsd0f8') == false)
				{
					$chunk = str_split(htmlspecialchars(strip_tags($v)), 35);
					return $chunk[0];
				}
				else return $v;
			}, $row));

		return $bstable->getHtml();
	}
}