<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2016 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Contact Template
 */
 // $Id$

if (!defined('e107_INIT')) { exit; }


$CONTACT_TEMPLATE['info'] = "

	<div id='contactInfo' >
		<address>{SITECONTACTINFO}</address>
	</div>

";


$CONTACT_TEMPLATE['menu'] =  '
	<div class="contactMenuForm">
		<div class="control-group form-group">
			<label for="contactName">'.LANCONTACT_03.'</label>
				{CONTACT_NAME}
		 </div>
		 
		<div class="control-group form-group">
			<label class="control-label" for="contactEmail">'.LANCONTACT_04.'</label>
				{CONTACT_EMAIL}
		</div>
		<div class="control-group form-group">
			<label for="contactBody" >'.LANCONTACT_06.'</label>
				{CONTACT_BODY=rows=5&cols=30}
		</div>
		<div class="form-group"><label for="gdpr">'.LANCONTACT_24.'</label>
		 
				{CONTACT_GDPR_CHECK}
				<div class="help-block">{CONTACT_GDPR_LINK}</div> 
			</div>
		</div>
		{CONTACT_SUBMIT_BUTTON: class=btn btn-sm btn-small btn-primary button}
	</div>       
 ';
 


// Shortcode wrappers.
$CONTACT_WRAPPER['form']['CONTACT_IMAGECODE'] 			= "<div class='control-group form-group'><label for='code-verify'>{CONTACT_IMAGECODE_LABEL}</label> {---}";
$CONTACT_WRAPPER['form']['CONTACT_IMAGECODE_INPUT'] 	= "{---}</div>";
$CONTACT_WRAPPER['form']['CONTACT_EMAIL_COPY'] 			= "<div class='control-group form-group'><div class='checkbox'><label for='email_copy' >{---}".LANCONTACT_07."</label></div></div>";
$CONTACT_WRAPPER['form']['CONTACT_PERSON']				= "<div class='control-group form-group'><label for='contactPerson'>".LANCONTACT_14."</label>{---}</div>";




$CONTACT_TEMPLATE['form'] = "
	<form action='".e_SELF."' method='post' id='contactForm' >

	{CONTACT_PERSON}
	<div class='control-group form-group'><label for='contactName'>".LANCONTACT_03."</label>
		{CONTACT_NAME}
	</div>
	<div class='control-group form-group'><label for='contactEmail'>".LANCONTACT_04."</label>
		{CONTACT_EMAIL}
	</div>
	<div class='control-group form-group'><label for='contactSubject'>".LANCONTACT_05."</label>
		{CONTACT_SUBJECT}
	</div>
   
		{CONTACT_EMAIL_COPY}

	<div class='control-group form-group'><label for='contactBody'>".LANCONTACT_06."</label>
		{CONTACT_BODY}
	</div>

	{CONTACT_IMAGECODE}
	{CONTACT_IMAGECODE_INPUT}

	<div class='form-group'>    
	{CONTACT_GDPR_CHECK: label=".LANCONTACT_21."}
    <small>{CONTACT_GDPR_LINK}</small>
	</div>
	
	

	<div class='form-group'>
	{CONTACT_SUBMIT_BUTTON}
	</div>

	</form>";

	// Customize the email subject
	// Variables:  CONTACT_SUBJECT and CONTACT_PERSON as well as any custom fields set in the form. )
$CONTACT_TEMPLATE['email']['subject'] = "{CONTACT_SUBJECT}";

$CONTACT_TEMPLATE['homepage'] =  '
 			<div class="row">
		      <div class="col-md-6">
		          <div class="form-group">              
		              <input type="text" class="form-control"    placeholder="'.LAN_AG_THEME_08.' *" id="contactName"  name="author_name" required data-validation-required-message="'.LAN_AG_THEME_09.'">
		              <p class="help-block text-danger"></p>
		          </div>
		          <div class="form-group">
		              <input type="email" class="form-control" placeholder="'.LAN_AG_THEME_10.' *" id="contactEmail"  name="email_send" required data-validation-required-message="'.LAN_AG_THEME_06.'">
		              <p class="help-block text-danger"></p>
		          </div>
		          <div class="form-group">
		              <input type="tel" class="form-control" placeholder="'.LAN_AG_THEME_05.' *" id="contactPhone"  name="phone" required data-validation-required-message="'.LAN_AG_THEME_11.'">
		              <p class="help-block text-danger"></p>
		          </div>
		      </div>
		      <div class="col-md-6">
		          <div class="form-group">
		              <textarea class="form-control" placeholder="'.LAN_AG_THEME_12.' *" id="contactBody"  name="body" required data-validation-required-message="'.LAN_AG_THEME_07.'"></textarea>
		              <p class="help-block text-danger"></p>
		          </div>
		      </div>
		      <div class="clearfix"></div>
		      <div class="col-lg-12 text-center">
		          <div id="success"></div>
		          <input type="submit" id="send-contactus" name="send-contactus" value="'.LAN_AG_THEME_13.'" class="btn btn-xl" />
		      </div>
		  </div>';