<?php namespace PaperClip\JellyCollection;

/**
 * Adds a search layer and makes few minor changes to make method chaining
 * more convienent. This version of the Collection if fully compatible with
 * \Illuminate\Support\Collection.
 */
class JellyCollection extends \Illuminate\Support\Collection
{
	/**
	 * Search a branch of nested arrays down the stream, for a specified key.
	 * @param  array $subject
	 * @param  string $searchKey
	 * @param  array $bag
	 * @return void
	 */
	protected function bagKeyRecursiveSearch(&$subject, $searchKey, &$bag, &$limit)
	{
		if(count($bag) <= $limit)
		{
			$this->putKeyIntoBagIfExists($subject, $searchKey, $bag);
				$this->keyTour($subject, function($key) use (&$subject, $searchKey, &$bag, &$limit) 
				{
					// If the key is an array, reapply the routine.
					if(is_array($subject[$key]))
						$this->bagKeyRecursiveSearch($subject[$key], $searchKey, $bag, $limit);
					// If the key is an instance of JellyCollection, extract the array
					// and reapply the routine.
					elseif($subject[$key] instanceof JellyCollection)
					{
						$subject = $subject[$key]->all();
						$this->bagKeyRecursiveSearch($subject, $searchKey, $bag, $limit);
					}
				});
		}
	}

	/**
	 * Search a branch of nested arrays down the stream, for a specified value.
	 * @param  array $subject
	 * @param  string $searchValue
	 * @param  array $bag
	 * @return void
	 */
	protected function bagValueRecursiveSearch(&$subject, $searchValue, &$bag, &$limit)
	{
		if(count($bag) <= $limit)
		{
			$this->putValueIntoBagIfExists($subject, $searchValue, $bag);
				$this->keyTour($subject, function($key) use (&$subject, $searchValue, &$bag, &$limit) 
				{
					// If the key is an array, reapply the routine.
					if(is_array($subject[$key]))
						$this->bagValueRecursiveSearch($subject[$key], $searchValue, $bag, $limit);
					// If the key is an instance of JellyCollection, extract the array
					// and reapply the routine.
					elseif($subject[$key] instanceof JellyCollection)
					{
						$subject = $subject[$key]->all();
						$this->bagValueRecursiveSearch($subject, $searchValue, $bag, $limit);
					}
				});
		}
	}

	/**
	 * Walk through keys of an array and apply an callback
	 * @param  array $array
	 * @param  callable $callback
	 * @return void
	 */
	protected function keyTour(&$subject, $callback)
	{
		$keys = array_keys($subject);
			// Check if there are keys in the array.
			if(!empty($keys))
				// Loop through all keys.
				foreach($keys as $index => &$key)
					$callback($key);
	}

	public function columnize()
	{
		$columnized = array();
		$items = &$this->items;
		$this->keyTour($items[0], function(&$key) use(&$columnized, $items)
		{
				$columnized[] = array_column($items, $key, 0);
		});
		return $columnized;
	}

	/**
	 * Walk through values of an array and apply an callback.
	 * @param  array $subject
	 * @param  callable $callback
	 * @return void
	 */
	protected function valueTour(&$subject, $callback)
	{
		$values = array_values($subject);
			// Check if there are keys in the array.
			if(!empty($values))
				// Loop through all keys.
				foreach($values as $index => $value)
					$callback($value);
	}

	/**
	 * Get the key if the key exists.
	 * @param  array $subject
	 * @param  string $key
	 * @param  array $bag
	 * @return void
	 */
	protected function putKeyIntoBagIfExists($subject, $key, &$bag)
	{
		if(array_key_exists($key, $subject))
			$bag[] = $subject[$key];
	}

	/**
	 * Get the key if the key exists.
	 * @param  array $subject
	 * @param  string $key
	 * @param  array $bag
	 * @return void
	 */
	protected function putValueIntoBagIfExists($subject, $value, &$bag)
	{
		if(($key = array_search($value, $subject)) !==  false)
			$bag[] = $key;
	}

	/**
	 * Search an array with dot separated keys.
	 * @param  string  $path
	 * @param  integer $limit
	 * @return PaperClip\JellyCollection\JellyCollection
	 */
	public function dotSearch($path)
	{
		$subject = array_dot($this->items);
		if(isset($subject[$path])) return new static(array($subject[$path]));
		return new static(array());
	}

	/**
	 * Recursively get a value/s by key.
	 * @param  string  $key
	 * @param  integer $limit
	 * @return mixed | null
	 */
	public function recursiveKeySearch($key, $limit = 1)
	{
		$bag = array();
		$limit = $limit;
		$this->bagKeyRecursiveSearch($this->items, $key, $bag, $limit);
		return new static($bag);
	}

	/**
	 * Recursively get a key/s by an value.
	 * @param  mixed  $value
	 * @param  integer $limit
	 * @return PaperClip\JellyCollection\JellyCollection
	 */
	public function recursiveSearch($value, $limit = 1)
	{
		$bag = array();
		$limit = $limit;
		$this->bagValueRecursiveSearch($this->items, $value, $bag, $limit);
		return new static($bag);
	}

	/**
	 * Search a key at one particular level in an array.
	 * @param  string $key
	 * @return PaperClip\JellyCollection\JellyCollection
	 */
	public function keySearch($key)
	{
		if(array_key_exists($key, $this->items))
			// If the found entity is an array then just simply use it to create a new collection.
			// If the found eneity is not an array then wrap the found entity in an array such that
			// a collection can be created anyway.
			return new static(is_array($items = $this->items[$key]) ? $items : array($items));
		// If nothing has been found then just return a collection. This will allow to freely chain
		// methods and focus only on the end-result, without worring about the middle steps.
		return new static(array());
	}

	/**
	 * Get the found results, in a convienent way.
	 * @return mixed
	 */
	public function result()
	{
		if($this->count() === 1) return head($this->items);
		elseif($this->count() > 1) return $this->items;
		else return null;
	}

	/**
	 * Get the top-most key name
	 * @return string
	 */
	public function firstKey()
	{
		$keys = array_keys($this->items);
		return head($keys);
	}
}