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
			'timelineendtext'       => array('title' => LAN_AG_THEMEPREF_01, 'type'=>'text', 'help'=>''),
			'teammemberclass'       => array('title' => LAN_AG_THEMEPREF_00, 'type'=>'userclass', 'help'=>''),
 		);


		return $fields;
 
	}

	function help()
	{
	 	return '';
	}
}

?>