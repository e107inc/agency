<?php
/**
 * Bootstrap 4 Theme for e107 v2.x
 */
if (!defined('e107_INIT')) { exit; }
 
// [multilanguage]
e107::lan('theme');


/* originally hardcoded in style.css NEED BE CHECKED */
$headerbackground = e107::pref('theme', 'headerbackground', FALSE); 
if($headerbackground) 
{
	$headerbackground = e107::getParser()->replaceConstants($headerbackground);
	$inlinecss1  = 'header {   background-image: url('.$headerbackground.') }';
	e107::css("inline", $inlinecss1);
}
/* override with theme prefs */
$inlinecss = e107::pref('theme', 'inlinecss', FALSE);
if($inlinecss) { 
	e107::css("inline", $inlinecss);
}
$inlinejs = e107::pref('theme', 'inlinejs');
if($inlinejs) { 
	e107::js("footer-inline", $inlinejs);
}

 
class theme implements e_theme_render
{
	public function init()
	{
		e107::meta('viewport', 'width=device-width, initial-scale=1.0');
	
		e107::js('url','https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js','','2','<!--[if lt IE 9]>','');
		e107::js('url','https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js','','2','','<![endif]-->'); 


		e107::css('url', 		'https://fonts.googleapis.com/css?family=Montserrat:400,700');
		e107::css('url', 		'https://fonts.googleapis.com/css?family=Kaushan+Script');
		e107::css('url', 		'https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic');
		e107::css('url', 		'https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700');

		e107::css('theme', 	'css/agency.min.css');


		e107::js("footer", 	'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'jquery'); 
		e107::js("theme", 	'js/agency.js', 'jquery'); 

	}

	public function tablestyle($caption, $text, $mode = '', $options = array())
	{
		$style = varset($options['setStyle'], 'default');


		if (e_DEBUG)
		{
			echo "
			<!-- tablestyle initial:  style=" . $style . "  mode=" . $mode . "  UniqueId=" . varset($options['uniqueId']) . " -->
			";
			echo "\n<!-- \n";

			echo json_encode($options, JSON_PRETTY_PRINT);

			echo "\n-->\n\n";
		}
 
		switch($mode) {
			case 'wm':
				$style = 'wm';
				break;

			case 'news_latest_menu':
			case 'lastseen':	
			case 'news_categories_menu':
			case 'comment_menu':	
			case 'login':	
	 
				$style = 'sidebar';
				break;

			default:
	 
				break;
		}

		if (e_DEBUG)
		{
			echo "
			<!-- tablestyle initial:  style=" . $style . "  mode=" . $mode . "  UniqueId=" . varset($options['uniqueId']) . " -->
			";
			echo "\n<!-- \n";

			echo json_encode($options, JSON_PRETTY_PRINT);

			echo "\n-->\n\n";
		}

		switch ($style)
		{
			case 'wm':
				echo '
				<div class="intro-lead-in">' . $caption . '</div>
				<div class="intro-heading">' . $text . '</div>';
		    return;				

			case 'none':
			case 'notitle':	
				echo $text;
				return;
			
			case 'contact':
				echo '<div class="col-lg-12 text-center">
				<h2 class="section-heading">'.$caption.'</h2>
				<h3 class="section-subheading text-muted">'.e107::pref('theme', 'contactsubtitle','').'</h3>
				</div>';
 
				echo '
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">'.$text.'
					</div>
				</div>';	
			return;		

			case 'sidebar':
				echo '<div class="panel panel-default">
				<div class="panel-heading">'.$caption.'</div> 
				'.$text.'
				</div>';
				return;	

			case 'menu':
				echo '<div class="panel panel-default">
				<div class="panel-heading">'.$caption.'</div>
				<div class="panel-body">
				'.$text.'
				</div>
				</div>';
				return;	
			 
			case 'portfolio':
				echo '
				<div class="col-lg-4 col-md-4 col-sm-6">
				'.$text.'
				</div>';	
				return;
			 

			case 'footer':
			echo '<h3>'.$caption.'</h3>'.$text;	
			return;


			case 'default':	
			default:

			if(!empty($caption))
			{
				echo '<h2 class="caption">'.$caption.'</h2>';
			}
			echo $text;					
			return;

		}
		return;
	}
}

