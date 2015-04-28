<?php

/**
 * Encode a string with dashes
 *  
 * @param  string $url
 * @return string
 */
function dash_encode($url)
{
  return preg_replace('/[^0-9A-Za-z\-]+/', '-', $url);
}