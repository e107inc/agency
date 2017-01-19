<?php

if (!defined('e107_INIT')) { exit; }

// Dummy Theme Configuration File.
class theme_config implements e_theme_config
{

	function __construct()
	{
		e107::themeLan('admin','agency', true);
	}


	function config()
	{
		// v2.1.4 format.

		$fields = array(
			 
 		);

		return $fields;
 
	}

	function help()
	{
	 	return '';
	}
}

?>