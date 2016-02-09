<?php
function Dwoo_Plugin_shorten(Dwoo_Core $dwoo, $str, $chars)
{
	if (strlen($str) > $chars) {
    	return substr($str, 0, $chars) . "...";
   	} else {
        return $str;
    }
}
