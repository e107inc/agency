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
			'timelineendtext'   => array('title' => LAN_AG_THEMEPREF_01, 'type'=>'text', 'writeParms'=>array('size'=>'block-level'), 'help'=>''),
			'textafterteam'   	=> array('title' => LAN_AG_THEMEPREF_02, 'type'=>'textarea', 'writeParms'=>array('size'=>'block-level'), 'help'=>''),
			'headerbackground'  => array('title' => LAN_AG_THEMEPREF_03, 'type'=>'image', 'help'=>''),
			'inlinecss'  				=> array('title' => LAN_THEMEPREF_01, 'type'=>'textarea', 'writeParms'=>array('size'=>'block-level'),'help'=>''),
			'inlinejs'   				=> array('title' => LAN_THEMEPREF_02, 'type'=>'textarea', 'writeParms'=>array('size'=>'block-level'),'help'=>''),			
			'cdn' => array('title' => 'CDN', 'type'=>'dropdown', 
			'writeParms'=>array('optArray'=>array( 'cdnjs' => 'CDNJS (Cloudflare)', 'jsdelivr' => 'jsDelivr'  , 'local' => 'Local folder' )))
 		);


		return $fields;
 
	}

	function help()
	{
	 	return '';
	}
}

?>