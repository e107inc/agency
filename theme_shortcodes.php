<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * e107 Bootstrap Theme Shortcodes. 
 *
*/


class theme_shortcodes extends e_shortcode
{
	function __construct()
	{
		
	}

 
	function sc_bootstrap_usernav($parm='')
	{
 
		include_lan(e_PLUGIN."login_menu/languages/".e_LANGUAGE.".php");
		
		$tp = e107::getParser();		   
		require(e_PLUGIN."login_menu/login_menu_shortcodes.php"); // don't use 'require_once'.
 		
		$userReg = defset('USER_REGISTRATION');
				   
		if(!USERID) // Logged Out. 
		{		
			$text = '';
			
			if($userReg==1)
			{
				$signuplink .= '<li class="nav-item"><a class="nav-link" href="'.e_SIGNUP.'">'.LAN_LOGINMENU_3.'</a></li>';
			}

			$socialActive = e107::pref('core', 'social_login_active');

			if(!empty($userReg) || !empty($socialActive)) // e107 or social login is active.
			{
				$loginlink   =  '
			  	<a class="nav-link dropdown-toggle" href="#" id="dropdownLoginLink" data-toggle="dropdown" aria-haspopup="true" 
					   aria-expanded="true" title="'.LAN_LOGINMENU_51.'"> '.LAN_LOGINMENU_51.'</a>';
        $sociallogin =  '{SOCIAL_LOGIN: size=2x&label=1}';
			}
			else
			{
				return '';
			}
			
			
			if(!empty($userReg)) // value of 1 or 2 = login okay. 
			{

			//	global $sc_style; // never use global - will impact signup/usersettings pages. 
			//	$sc_style = array(); // remove any wrappers.

				$loginform  ='	
				<form method="post" onsubmit="hashLoginPassword(this);return true" action="'.e_REQUEST_HTTP.'" accept-charset="UTF-8">
				<p>{LM_USERNAME_INPUT}</p>
				<p>{LM_PASSWORD_INPUT}</p>
				<div class="form-group"></div>
				{LM_IMAGECODE_NUMBER}
				{LM_IMAGECODE_BOX}				
				<div class="checkbox">				
				<label class="string optional" for="autologin"><input style="margin-right: 10px;" type="checkbox" name="autologin" id="autologin" value="1">
				'.LAN_LOGINMENU_6.'</label>
				</div>
				<input class="btn btn-primary btn-block" type="submit" name="userlogin" id="userlogin" value="'.LAN_LOGINMENU_51.'">
				';
				
				$loginform .= '				
				<a href="{LM_FPW_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LAN_LOGINMENU_4.'</a>
				<a href="{LM_RESEND_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LAN_LOGINMENU_40.'</a>
				';
 
				$loginform .= "<p></p>
				</form>
				";			
			}
			
		   	$text = ' '.
		   	$signuplink.
				'<li class="nav-item dropdown show">
				     '.$loginlink.$sociallogin.'
					   <div class="dropdown-menu" aria-labelledby="dropdownLoginLink" style="min-width:250px; padding: 15px; padding-bottom: 0px;">
						  '.$loginform.'
					   </div>
				</li>';
	
			$text .= '';			
			return $tp->parseTemplate($text, true, $login_menu_shortcodes);
		}  

		
		// Logged in. 
		//TODO Generic LANS. (not theme LANs) 	
		if(ADMIN) 
		{
			$adminlink = '<a class="dropdown-item" href="'.e_ADMIN_ABS.'"><span class="fa fa-cogs"></span> '.LAN_LOGINMENU_11.'</a>';	
		}	
		else $adminlink = '';
			
		$text = ' 
		<li class="nav-item dropdown show">
			<a class="nav-link dropdown-toggle" href="{LINK_URL}" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" 
			   aria-expanded="true" title="{LINK_DESCRIPTION}"> {SETIMAGE: w=20} {USER_AVATAR: shape=circle} '. USERNAME.'</a>
			   <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				  <a class="dropdown-item" href="{LM_USERSETTINGS_HREF}"><span class="fa fa-cog"></span> '.LAN_SETTINGS.'</a>
				  <a class="dropdown-item" href="{LM_PROFILE_HREF}"><span class="fa fa-user"></span> '.LAN_LOGINMENU_13.'</a>
				  '.$adminlink.'
				  <a class="dropdown-item" href="'.e_HTTP.'index.php?logout"><span class="fa fa-sign-out"></span> '.LAN_LOGOUT.'</a>
			   </div>
		</li>'; 
		return $tp->parseTemplate($text,true,$login_menu_shortcodes);
	}


	function sc_portfolioitems()
	{
		$template = e107::getCoreTemplate('chapter', 'portfolio');
		$sc = e107::getScBatch('page', null, 'cpage');

		//return print_a($sc,true);
		// ONLY ONE BOOK WITH TEMPLATE PORTFOLIO

		$book = e107::getDb()->retrieve("SELECT chapter_id, chapter_name, chapter_meta_description FROM #page_chapters WHERE chapter_visibility IN (" . USERCLASS_LIST . ") AND chapter_template = 'portfolio'  LIMIT 1", true);
		$page['book_id'] = $book[0]['chapter_id'];
		$page['book_name'] = $book[0]['chapter_name'];
		$page['book_desc'] = $book[0]['chapter_meta_description'];

		// $page['book_sef'] = $bookSef;

		$var = array(
				'BOOK_NAME' => e107::getParser()->toHtml($page['book_name']),
				'BOOK_DESC' => e107::getParser()->toHtml($page['book_desc']),
		);
		$body = e107::getParser()->simpleParse($template['listItems']['caption'], $var);

		// TO GET ALL PAGES, WITH THEIR CHAPTERS WITH BOOK PORTFOLIO

		$query = "SELECT * FROM #page AS p LEFT JOIN #page_chapters as ch ON p.page_chapter=ch.chapter_id WHERE ch.chapter_parent = " . intval($page['book_id']) . " ORDER BY p.page_order DESC ";

		$text = e107::getParser()->parseTemplate($template['listItems']['start'], true, $sc);

		if($pageArray = e107::getDb()->retrieve($query, true))
		{
			foreach($pageArray as $page)
			{
				$sc->setVars($page);
				$text .= e107::getParser()->parseTemplate($template['listItems']['item'], true, $sc);
			}
		}
		else
		{
			$text = 'No Portfolio items';
		}

		$text .= e107::getParser()->parseTemplate($template['listItems']['end'], true, $sc);

		return $body . $text;
	}


	function sc_modalportfolio()
	{
		$template = e107::getCoreTemplate('chapter', 'modalportfolio');
		$sc = e107::getScBatch('page', null, 'cpage');

	//	return print_a($sc,true);

		// XXX Much of this is already loaded by getScBatch();

		// ONLY ONE BOOK WITH TEMPLATE PORTFOLIO

		$book = e107::getDb()->retrieve("SELECT chapter_id, chapter_name, chapter_meta_description FROM #page_chapters WHERE chapter_visibility IN (" . USERCLASS_LIST . ") AND chapter_template = 'portfolio'  LIMIT 1", true);
		$page['book_id'] = $book[0]['chapter_id'];
		$page['book_name'] = $book[0]['chapter_name'];
		$page['book_desc'] = $book[0]['chapter_meta_description'];

		// $page['book_sef'] = $bookSef;

		$var = array(
				'BOOK_NAME' => e107::getParser()->toHtml($page['book_name']),
				'BOOK_DESC' => e107::getParser()->toHtml($page['book_desc']),
		);
		$body = e107::getParser()->simpleParse($template['listItems']['caption'], $var);

		// TO GET ALL PAGES, WITH THEIR CHAPTERS WITH BOOK PORTFOLIO

		$query = "SELECT * FROM #page AS p LEFT JOIN #page_chapters as ch ON p.page_chapter=ch.chapter_id WHERE ch.chapter_parent = " . intval($page['book_id']) . " ORDER BY p.page_order DESC ";


		$text = e107::getParser()->parseTemplate($template['listItems']['start'], true, $sc);

		if($pageArray = e107::getDb()->retrieve($query, true))
		{
			foreach($pageArray as $page)
			{
				$sc->setVars($page);
				$text .= e107::getParser()->parseTemplate($template['listItems']['item'], true, $sc);
			}
		}
		else
		{
			$text = 'No Portfolio items';
		}

		$text .= e107::getParser()->parseTemplate($template['listItems']['end'], true, $sc);

		return $body . $text;


	}


	//@todo if this is done often, sc_xurl_icons() needs a template.
	function sc_xurl_icons()
	{
		$social = array(
				'rss'             => array('href' => (e107::isInstalled('rss_menu') ? e107::url('rss_menu', 'index', array('rss_url' => 'news')) : ''), 'title' => 'RSS/Atom Feed'),
				'facebook'        => array('href' => deftrue('XURL_FACEBOOK'), 'title' => 'Facebook'),
				'twitter'         => array('href' => deftrue('XURL_TWITTER'), 'title' => 'Twitter'),
				'google-plus'     => array('href' => deftrue('XURL_GOOGLE'), 'title' => 'Google Plus'),
				'linkedin'        => array('href' => deftrue('XURL_LINKEDIN'), 'title' => 'LinkedIn'),
				'github'          => array('href' => deftrue('XURL_GITHUB'), 'title' => 'Github'),
				'pinterest'       => array('href' => deftrue('XURL_PINTEREST'), 'title' => 'Pinterest'),
				'flickr'          => array('href' => deftrue('XURL_FLICKR'), 'title' => 'Flickr'),
				'instagram'       => array('href' => deftrue('XURL_INSTAGRAM'), 'title' => 'Instagram'),
				'youtube'         => array('href' => deftrue('XURL_YOUTUBE'), 'title' => 'YouTube'),
				'question-circle' => array('href' => deftrue('XURL_VIMEO'), 'title' => 'e107 HELP')
		);


		$text = '';
		$textstart = '<ul class="list-inline social-buttons">';
		$textend = '</ul>';
		foreach($social as $id => $data)
		{
			if($data['href'] != '')
			{
				$text .= '<li class="list-inline-item">
             <a rel="external" href="' . $data['href'] . '" class="btn-social btn-outline"><i class="fa fa-' . $id . '"></i></a>';
				$text .= "</li>\n";
			}
		}
		if($text != '')
		{
			return $textstart . $text . $textend;
		}

	}

	/* WORKAROUND for using just icon name */
	function sc_cmenu_button_text()
  {
    $sc   = e107::getScBatch('page', null, 'cpage');
    $data = $sc->getVars();
    return vartrue($data['menu_button_text'],'');
   }
 
}

?>
