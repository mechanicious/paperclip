<?php namespace PaperClip\Table;

use PaperClip\Table\Column;

use Illuminate\Support\Contracts\ArrayableInterface;

class Columnizer
{
	use \PaperClip\Support\Traits\AssociativeTrait;

	/**
	 * Holds columns.
	 */
	private $columnList = array();
	
	/**
	 * Assings a name to every column.
	 * @return Columnizer;
	 */
	private function nameColumns()
	{
		if(!empty($this->subject))
		{
			$names = array_keys($this->subject[0]);
			foreach ($names as $name)
				array_push($this->columnList, new Column($name));
		}

		return $this;
	}

	/**
	 * Puts every value into the respective column.
	 * @return void
	 */
	private function sortRows()
	{
		$subject = $this->subject;
		if(!empty($subject))
		{
			foreach($this->columnList as $column)
					foreach ($subject as $row)
						foreach($row as $spikeName => $spikeValue)
							if($column->getName() == $spikeName)
							{
								$column->put($spikeValue);
							}
		}
					
		return $this;
	}

	/**
	 * Returns an array with columns.
	 * @param  array $preparedArray
	 * @return array
	 */
	public function make($preparedArray)
	{
		$this->subject = $preparedArray;
		$subject = $this->subject;
		if(!empty($subject))
		{
			// process the array
			$this->nameColumns()->sortRows();
		}
		return $this->columnList;
	}
}