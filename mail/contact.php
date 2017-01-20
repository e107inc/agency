<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2013 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * /contact.php
 * Modified just to send email after ajax calling
*/

require_once("../../../class2.php");

include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/lan_'.e_PAGE);

 
	$error          = "";
	$ignore         = false;


	// Contact Form Filter -----

	$contact_filter = e107::pref('core','contact_filter','');

	if(!empty($contact_filter))
	{
		$tmp = explode("\n", $contact_filter);

		if(!empty($tmp))
		{
			foreach($tmp as $filterItem)
			{
				if(strpos($_POST['body'], $filterItem)!==false)
				{
					$ignore = true;
					break;
				}

			}
		}
	}


	// No errors - so proceed to email the admin and the user (if selected).
	if($ignore === true)
    {
        $ns->tablerender('', "<div class='alert alert-success'>".LANCONTACT_09."</div>"); // ignore and leave them none the wiser.
        e107::getDebug()->log("Contact form post ignored");
        require_once(FOOTERF);
		exit;
    }
    elseif(empty($error))
	{
		$body .= "<br /><br />
		<table class='table'>
		<tr>
		<td>IP:</td><td>".e107::getIPHandler()->getIP(TRUE)."</td></tr>";

		if (USER)
		{
			$body .= "<tr><td>User:</td><td>#".USERID." ".USERNAME."</td></tr>";
		}

		if(empty($_POST['contact_person']) && !empty($pref['sitecontacts'])) // only 1 person, so contact_person not posted.
		{
    		if($pref['sitecontacts'] == e_UC_MAINADMIN)
			{
        		$query = "user_perms = '0' OR user_perms = '0.' ";
			}
			elseif($pref['sitecontacts'] == e_UC_ADMIN)
			{
				$query = "user_admin = 1 ";
			}
			else
			{
				$query = "FIND_IN_SET(".$pref['sitecontacts'].",user_class) ";
			}
		}
		else
		{
      		$query = "user_id = ".intval($_POST['contact_person']);
		}

    	if($sql->gen("SELECT user_name,user_email FROM `#user` WHERE ".$query." LIMIT 1"))
		{
    		$row = $sql->fetch();
    		$send_to = $row['user_email'];
			$send_to_name = $row['user_name'];
		}
    	else
		{
		    $send_to = SITEADMINEMAIL;
			$send_to_name = ADMIN;
		}


		// ----------------------

		$CONTACT_EMAIL = e107::getCoreTemplate('contact','email');

		unset($_POST['contact_person'], $_POST['author_name'], $_POST['email_send'] , $_POST['subject'], $_POST['body'], $_POST['rand_num'], $_POST['code_verify'], $_POST['send-contactus']);

		if(!empty($_POST)) // support for custom fields in contact template.
		{
			foreach($_POST as $k=>$v)
			{
				$body .=  "<tr><td>".$k.":</td><td>".$tp->toEmail($v, true,'RAWTEXT')."</td></tr>";
			}
		}

		$body .= "</table>";

		if(!empty($CONTACT_EMAIL['subject']))
		{
			$vars = array('CONTACT_SUBJECT'=>$subject,'CONTACT_PERSON'=>$send_to_name);

			if(!empty($_POST)) // support for custom fields in contact template.
			{
				foreach($_POST as $k=>$v)
				{
					$scKey = strtoupper($k);
					$vars[$scKey] =$tp->toEmail($v, true,'RAWTEXT');
				}
			}

			$subject = $tp->simpleParse($CONTACT_EMAIL['subject'],$vars);
		}

		// -----------------------

		// Send as default sender to avoid spam issues. Use 'replyto' instead. 
    	$eml = array(
    	    'subject'       => $subject,
    	    'sender_name'   => $sender_name,
    	    'body'          => $body,
		    'replyto'       => $sender,
		    'replytonames'  => $sender_name,
		    'template'      => 'default'
	    );


	    $message = e107::getEmail()->sendEmail($send_to, $send_to_name, $eml, false)  ? LANCONTACT_09 : LANCONTACT_10;
 
}
echo json_encode($message);
?>