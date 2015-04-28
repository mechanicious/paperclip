<?php namespace PaperClip\Table;

use Illuminate\Support\Contracts\ArrayableInterface;

class Column implements ArrayableInterface, \Countable
{
	/**
	 * Holds the name of the column.
	 */
	private $name = null;
	/**
	 * Holds the rows. Each index is considered a row.
	 */
	private $rowList = array();

	/**
	 * Holds index of the found row.
	 */
	private $find = null; 

	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns all rows optionaly can set rows to an array.
	 * @param  array $rows
	 * @return array
	 */
	public function rows($rows = array())
	{
		if(!empty($rows))
			$this->rowList = $rows;
		return $this->rowList;
	}

	/**
	 * Counts number of rows.
	 * @return int
	 */	
	public function count()
	{
		return count($this->rowList);
	}

	/**
	 * Retuns the array representation of the column.
	 * @return array
	 */
	public function toArray()
	{
		$name = $this->name;
		$column = array();
		$column[$name] = array();
		$rows = $this->rowList;
		
		foreach($rows as $row)
			array_push($column, $row);

		return $column;
	}

	/**
	 * Searches for a value in the column and returns it.
	 * @param  int|string $value
	 * @return int|string
	 */
	public function find($value)
	{
		$rows = $this->rowList;
		return array_search($value, $rows); 
	}

	/**
	 * Puts a row into the column.
	 * @param  int|string|array $value
	 * @return void
	 */
	public function put($value)
	{
		if(!is_array($value))
			array_push($this->rowList, $value);
		else
			$this->rowList = array_merge($this->rowList, $value);
	}

	/**
	 * Returns a value and then removes it.
	 * @return int|string
	 */
	public function pull()
	{
		if(!empty($this->rowList))
		{
			$value = $this->rowList[0];
			$this->remove(0);
			return $value;
		}
		return null;
	}

	/**
	 * Removes a row by index.
	 * @param  int|string $index
	 * @return void
	 */
	public function remove($index)
	{
		if(isset($this->rowList[$index]))
		{
			unset($this->rowList[$index]);
			// reset indexes
			$this->rowList = array_values($this->rowList);
		}
	}

	public function getName()
	{
		return $this->name;
	}

	/**
	 * Renames the column.
	 * @param  int|string $name
	 * @return void
	 */
	public function rename($name)
	{
		$this->name = $name;
	}
}