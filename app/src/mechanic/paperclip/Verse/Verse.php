<?php namespace PaperClip\Verse;

/**
 * Verse is created group string-filter-functions together.
 * It aims to provice a convienient way to manipulate strings
 * implementing the Eloquent design pattern.
 */
class Verse
{
	/**
	 * The string being worked on.
	 * @var string
	 */
	protected $verse = null;

	/**
	 * Holds the string's length 
	 */
	protected $length = null;

	/**
	 * Proxy
	 * Proxifies to the $verse property.
	 * @return string
	 */
	protected function subject()
	{
		return is_string($temp = &$this->verse) ? $temp : "";
	}

	/**
	 * Global Setter
	 * Sets the $verse property value.
	 * @param string $entity
	 */
	protected function set($entity)
	{
		$this->verse = $entity;
		return $this;
	}

	/**
	 * Splits a string into pieces of a certain length.
	 * @param  string $string
	 * @return array
	 */
	protected function splitString($anyString, $length)
	{
		return str_split($anyString, $length);
	}

	/**
	 * Checks if the string is a valid entrance.
	 * @param  string $anyString
	 * @return boolean
	 */
	protected function validEntrance($anyString)
	{
		return is_string($anyString) ? true : false;
	}

	/**
	 * Sets the subject of filtering.
	 * @param  string $anyString
	 * @return PaperClip/Verse/Verse
	 */
	public function equals($anyString)
	{
		$this->set($anyString);
		return $this;
	}

	/**
	 * Remove tags from a string
	 * @param  string $entrance
	 * @return PaperClip\Verse\Verse
	 */
	public function stripTags()
	{
		$this->set(strip_tags($this->subject()));
		return $this;
	}

	/**
	 * Escape special all characters.
	 * @return PaperClip/Verse/Verse
	 */
	public function encodeEntites()
	{
		$this->set(htmlentities($this->subject()));
		return $this;
	}

	public function encodeSpecial()
	{
		$this->set(htmlspecialchars($this->subject()));
		return $this;
	}

	/**
	 * Max length
	 * @param  int $length
	 * @return PaperClip/Verse/Verse
	 */
	public function first($length)
	{
		$this->length = $length;
		$verse = $this->subject();
		$verse = $this->splitString($verse, $length);
		$first = 0;
		$this->set($verse[$first]);
		return $this;
	}

	/**
	 * Add a string to the end of a string.
	 * @return PaperClip/Verse/Verse
	 */
	public function append($anyString)
	{
		if( ! is_null($this->length) && strlen($this->subject()) <= $this->length) return $this;
		$this->set($this->subject() . $anyString);
		return $this;
	}

	/**
	 * Add a string to the beginning of a string.
	 * @param  string $anyString
	 * @return PaperClip/Verse/Verse
	 */
	public function prepend($anyString)
	{
		$this->set($anyString . $this->subject());
		return $this;
	}

	/**
	 * Replace a occurence in a string by something else.
	 * @param  string $needle
	 * @param  string $replacement
	 * @param  string $entrance
	 * @return PaperClip/Verse/Verse
	 */
	public function replace($needle, $replacement, $max = null)
	{
		$haystack = $this->subject();
		$this->set(str_replace($needle, $replacement, $haystack, $max));
		return $this;
	}

	/**
	 * Get the parsed string.
	 * @return string	
	 */
	public function get()
	{
		return $this->subject();
	}

	/**
	 * Put newline-separated parahraphs into HTML <p> tag
	 * 
	 * @return string
	 */
	public function paragraphize()
	{
		$str = preg_replace('/\n(\s*\n)+/', '</p><p>', $str);
		$str = preg_replace('/\n/', '<br>', $str);
	 	$this->set('<p>'.$str.'</p>');
	 	return $this;
	}
}