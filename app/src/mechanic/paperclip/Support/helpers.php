<?php

	/**
	 * Encode a string with dashes
	 *  
	 * @param  string $url
	 * @return string
	 */
	function dash_encode($url)
	{
	  return preg_replace('/[^0-9A-Za-z\-\/\:]+/', '-', $url);
	}

	function startsWith($haystack, $needle) {
		if(is_array($needle)) {
			foreach ($needle as $val) {
				$found = $needle === "" || strrpos($haystack, $val, -strlen($haystack)) !== FALSE;
				if($found) return true;
			}
			return false;
		}
	    // search backwards starting from haystack length characters from the end
	    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}

	function endsWith($haystack, $needle) {
		if(is_array($needle)) {
			foreach ($needle as $val) {
				$found = $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
				if($found) return true;
			}
			return false;
		}
	    // search forward starting from end minus needle length characters
	    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}