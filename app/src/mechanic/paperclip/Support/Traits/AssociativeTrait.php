<?php
namespace PaperClip\Support\Traits;

trait AssociativeTrait
{
	public function is_associative($array)
	{
		for (reset($array); is_int(key($array)); next($array));
		return is_null(key($array));
	}

	public function change_key( $array, $old_key, $new_key) 
	{
	    if( ! array_key_exists( $old_key, $array ) )
	        return $array;

	    $keys = array_keys( $array );
	    $keys[ array_search( $old_key, $keys ) ] = $new_key;

	    return array_combine( $keys, $array );
	}
}