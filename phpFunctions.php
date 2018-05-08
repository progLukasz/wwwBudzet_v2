<?php
function compareStrings($string1raw, $string2raw)
	{
		
		$string1 = ltrim($string1raw);
		$string1 = rtrim($string1raw);
		$string2 = ltrim($string2raw);
		$string2 = rtrim($string2raw);
		
		return strcasecmp($string1, $string2);
	}
	
?>