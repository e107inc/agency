<?php


#### Panel Template - Used by menu_class.php  for Custom Menu Content. 


	$MENU_TEMPLATE['default']['start'] 					= ''; 
	$MENU_TEMPLATE['default']['body'] 					= '{CMENUBODY}'; 
	$MENU_TEMPLATE['default']['end'] 					= ''; 

	$MENU_TEMPLATE['button']['start'] 					= '<div class="cpage-menu">'; 
	$MENU_TEMPLATE['button']['body'] 					= '<div>{CMENUBODY}</div>{CPAGEBUTTON}';
	$MENU_TEMPLATE['button']['end'] 					= '</div>'; 

	### Additional control over image thumbnailing is possible via SETIMAGE e.g. {SETIMAGE: w=200&h=150&crop=1}
	$MENU_TEMPLATE['buttom-image']['start'] 			= '<div class="cpage-menu">'; 
	$MENU_TEMPLATE['buttom-image']['body'] 				= '<div>{CMENUIMAGE}</div>{CPAGEBUTTON}';
	$MENU_TEMPLATE['buttom-image']['end'] 				= '</div>'; 



	$MENU_TEMPLATE['2-column_1:1_text-left']['start'] 	= '{SETIMAGE: w=700&h=450}'; 
	$MENU_TEMPLATE['2-column_1:1_text-left']['body'] 	= '			
													       <div class="cpage-menu col-lg-6 col-md-6 col-sm-6"><h2>{CMENUICON}{CMENUTITLE}</h2>{CMENUBODY}<p>{CPAGEBUTTON}</p></div>
													       <div class="cpage-menu col-lg-6 col-md-6 col-sm-6">{CMENUIMAGE}</div>
													       '; 
	$MENU_TEMPLATE['2-column_1:1_text-left']['end'] 	= ''; 
	
	
	$MENU_TEMPLATE['2-column_1:1_text-right']['start'] = '{SETIMAGE: w=700&h=450}'; 
	$MENU_TEMPLATE['2-column_1:1_text-right']['body'] 	= '
															<div class="cpage-menu col-lg-6 col-md-6 col-sm-6">{CMENUIMAGE}</div>
															<div class="cpage-menu col-lg-6 col-md-6 col-sm-6"><h2>{CMENUICON}{CMENUTITLE}</h2>{CMENUBODY}<p>{CPAGEBUTTON}</p></div>
														'; 		
	$MENU_TEMPLATE['2-column_1:1_text-right']['end'] 	= ''; 
          
 
	$MENU_TEMPLATE['2-column_2:1_text-left']['start'] 	= ''; 
	$MENU_TEMPLATE['2-column_2:1_text-left']['body'] 	= '			
													       <div class="cpage-menu col-lg-8 col-md-8"><h4>{CMENUICON}{CMENUTITLE}</h4>{CMENUBODY}</div>
													       <div class="cpage-menu col-lg-4 col-md-4">
													       <a class="btn btn-lg btn-primary pull-right" href="{CPAGEBUTTON=href}">'.LAN_READ_MORE.'</a>
													       </div>
													       '; 
	$MENU_TEMPLATE['2-column_2:1_text-left']['end'] 	= '';  
 
	$MENU_TEMPLATE['home-introduction-text']['start'] 			= ''; 
	$MENU_TEMPLATE['home-introduction-text']['body'] 				= 
									'<h2 class="section-heading">{CMENUTITLE}</h2>
								   <h3 class="section-subheading text-muted">{CMENUBODY}</h3>';
	$MENU_TEMPLATE['home-introduction-text']['end'] 				= '';

            

	$MENU_TEMPLATE['home-services']['start'] 			= 
	'<span class="fa-stack fa-4x">
	<i class="fa fa-circle fa-stack-2x text-primary"></i>
	<i class="fa {CMENU_BUTTON_TEXT} fa-stack-1x fa-inverse"></i>
	</span>'; 
	$MENU_TEMPLATE['home-services']['body'] 				= '<h4 class="service-heading">{CMENUTITLE}</h4>
	<p class="text-muted">{CMENUBODY}';
	$MENU_TEMPLATE['home-services']['end'] 				= ' '; 
 

    // Cam rework.

	$MENU_TEMPLATE['teammember']['start'] 				= '' ;
	$MENU_TEMPLATE['teammember']['body'] 				= '
	                <div class="col-sm-4">
	                    <div class="team-member">
	                        <img src="{CMENUIMAGE=url}" class="img-responsive img-circle" alt="">
	                        <h4>{CPAGETITLE}</h4>
	                        <p class="text-muted">{CMENUTITLE}</p>
	                        <ul class="list-inline social-buttons">
	                            <li><a href="{CPAGEFIELD: name=twitter&mode=raw}"><i class="fa fa-twitter"></i></a>
	                            </li>
	                            <li><a href="{CPAGEFIELD: name=facebook&mode=raw}"><i class="fa fa-facebook"></i></a>
	                            </li>
	                            <li><a href="{CPAGEFIELD: name=linkedin&mode=raw}"><i class="fa fa-linkedin"></i></a>
	                            </li>
	                        </ul>
	                    </div>
	                </div>';
	$MENU_TEMPLATE['teammember']['end'] 					= '';



	
?>