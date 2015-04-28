<?php namespace PaperClip\Table;

use Jacopo\Bootstrap3Table\BootstrapTable;

class Table
{
	public function __construct()
	{
		$this->bst	= new BootstrapTable;
		$this->bst->setConfig(array("table-hover"=>false, "table-condensed"=>true, "table-striped"=>true, "table-bordered" =>true));
	}

	public function buildTable($paginate, $deleteUrl, $editUrl)
	{
		$this->editUrl 		= $editUrl;
		$this->deleteUrl 	= $deleteUrl;

		$paginate = $paginate->toArray();
		if(!$this->table = $paginate['data'])
			return $this->bst;

		$this->setColumns()
		->setRows();
		return $this->bst;
	}

	private function setColumns()
	{
		$columns = array_keys($this->table[0]);
		
		foreach ($columns as &$column)
			$column = ucwords(preg_replace('/[^a-zA-Z0-9]/', " ", $column));
		$this->bst->setHeader(array_merge($columns, array(ucfirst("Operations"))));
		return $this;
	}

	private function setRows()
	{
		$table = $this->table;
		$rows = array();
		foreach ($table as $row)
			$this->bst->addRows(array_merge(array_values($row), array($this->getButtonsHTML())));
		return $this;
	}

	private function getButtonsHTML()
	{
		return 	'<a href="'.$this->deleteUrl.'" class="btn btn-mini btn-danger" 	type="submit"><i class="btn-icon-only icon-remove"></i> Delete</a>
    			 <a href="'.$this->editUrl.'" class="btn btn-mini btn-primary" 	type="submit"><i class="btn-icon-only icon-edit"></i> Edit</a>';
	}
}