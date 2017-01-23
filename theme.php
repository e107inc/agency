<?php
/**
 * Bootstrap 4 Theme for e107 v2.x
 */
if (!defined('e107_INIT')) { exit; }

define("BOOTSTRAP", 	3);
define("FONTAWESOME", 	4);
define('VIEWPORT', 		"width=device-width, initial-scale=1.0");


/* @see https://www.cdnperf.com */
// Warning: Some bootstrap CDNs are not compiled with popup.js
// use https if e107 is using https.

e107::lan('theme');

$cndPref = e107::pref('theme', 'cdn','local');

switch($cndPref)
{		
  case "local": //@todo  add back once correct core path is determined.
		e107::css('theme', 'vendor/bootstrap/css/bootstrap.min.css');
		e107::css('theme', 'vendor/font-awesome/css/font-awesome.min.css');
		e107::js('theme', 'vendor/bootstrap/js/bootstrap.min.js', 'jquery');		
  break;	     
 	case "cdnjs":  
	default:
    e107::js("footer", "https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js", 'jquery', 2);
    e107::css('url', 'https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css');
    e107::css('url',    'https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css');
}

e107::js('url','https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js','','2','<!--[if lt IE 9]>','');
e107::js('url','https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js','','2','','<![endif]-->'); 


e107::css('url', 		'https://fonts.googleapis.com/css?family=Montserrat:400,700');
e107::css('url', 		'https://fonts.googleapis.com/css?family=Kaushan+Script');
e107::css('url', 		'https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic');
e107::css('url', 		'https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700');

e107::css('theme', 	'css/agency.min.css');


e107::js("footer", 	'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'jquery'); 
e107::js("theme", 	'js/jqBootstrapValidation.js"', 'jquery');
e107::js("theme", 	'js/contact_me.js', 'jquery');
e107::js("theme", 	'js/agency.js', 'jquery'); 


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

define('BODYTAG', '<body id="page-top" data-spy="scroll" class="index layout-'.THEME_LAYOUT.'">');
 

//e107::js("footer-inline", 	"$('.e-tip').tooltip({container: 'body'})"); // activate bootstrap tooltips. 

// Legacy Stuff.
define('OTHERNEWS_COLS',false); // no tables, only divs. 
define('OTHERNEWS_LIMIT', 3); // Limit to 3. 
define('OTHERNEWS2_COLS',false); // no tables, only divs. 
define('OTHERNEWS2_LIMIT', 3); // Limit to 3. 
define('COMMENTLINK', 	e107::getParser()->toGlyph('fa-comment'));
define('COMMENTOFFSTRING', '');

define('PRE_EXTENDEDSTRING', '<br />');

$imagepath = e_THEME_ABS.'agency/install/';

/**
 * @param string $caption
 * @param string $text
 * @param string $id : id of the current render
 * @param array $info : current style and other menu data. 
 */
function tablestyle($caption, $text, $id='', $info=array()) 
{
//	global $style; // no longer needed. 
	
	$style = $info['setStyle'];
	
	echo "<!-- tablestyle: style=".$style." id=".$id." -->\n\n";
	
	$type = $style;
	if(empty($caption))
	{
		$type = 'box';
	}
	
	if($style == 'navdoc' || $style == 'none')
	{
		echo $text;
		return;
	}
	
	if ($id == 'wm') // Example - If rendered from 'welcome message'
	{
		echo '
	      <div class="intro-lead-in">' . $caption . '</div>
	      <div class="intro-heading">' . $text . '</div>';
		return;
	}
	
	/* need be checked */
	if($style == 'contact')
	{
	  echo '<div class="row">
          <div class="col-lg-12 text-center">
              <h2>'.$caption.'</h2>
              <hr class="star-primary">
          </div>
      </div>
      <div class="row">
          <div class="col-lg-8 col-lg-offset-2"> '.$text.'
          </div>
      </div>';	
		return;
	}
	
	if($style == 'footer')
	{
		echo '<h3>'.$caption.'</h3>'.$text;	
		return;
	}
	
	if($style == 'col-md-4' || $style == 'col-md-6' || $style == 'col-md-8')
	{
		
		if(!empty($caption))
		{
            echo '<h3>'.$caption.'</h3>';
		}

		echo $text;
		return;	
		
	}
	
	if($id == 'news_latest_menu' OR $id == 'lastseen' OR  $id == 'news_categories_menu' OR $id == "news_months_menu" 
	OR $id == 'comment_menu') 
	{
		echo '<div class="panel panel-default">
	  <div class="panel-heading">'.$caption.'</div> 
	   '.$text.'
  	</div>';
		return;	
	}
 	  		
	if($style == 'menu')
	{
		echo '<div class="panel panel-default">
	  <div class="panel-heading">'.$caption.'</div>
	  <div class="panel-body">
	   '.$text.'
	  </div>
	</div>';
		return;	
	}	
	
	
	if($style == 'portfolio')
	{
		 echo '
		 <div class="col-lg-4 col-md-4 col-sm-6">
            '.$text.'
		</div>';	
		return;
	}

	if($style == 'notags')
	{
	  echo str_replace(array("<p>","</p>"), "", $text);
		return;
	}
	
	if($style == 'notitle')
	{
	  echo $text;
		return;
	}


	// default.
	if(!empty($caption))
	{
		echo '<h2 class="caption">'.$caption.'</h2>';
	}
	echo $text;					
	return;
}
// for multipage purpose
$navbartype = 'navbar-inverse';
if(THEME_LAYOUT == 'homepage'  )
{
 $navbartype = "navbar-default ";
}

// applied before every layout. 
$LAYOUT['_header_'] = '
<!-- Navigation -->
<nav id="mainNav" class="navbar  '.$navbartype.' navbar-custom navbar-fixed-top">  
  <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand page-scroll" href="#page-top">{SITENAME}</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
						 {NAVIGATION=main}
						 {BOOTSTRAP_USERNAV}
					</ul>
      </div>
  </div>
</nav>
';

// applied after every layout. 
$LAYOUT['_footer_'] = ' 
{SETSTYLE=footer}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">{SITEDISCLAIMER=2017}</span>
                </div>
                <div class="col-md-4">
                   {XURL_ICONS}
                </div>
                <div class="col-md-4">
                  {NAVIGATION=footer}                    
                </div>
            </div>
        </div>
    </footer>
    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->
    {MODALPORTFOLIO}
';

// $LAYOUT is a combined $HEADER and $FOOTER, automatically split at the point of "{---}"

$LAYOUT['homepage'] =  '
<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">                               
            {SETSTYLE=wm}
            {---}             
        </div>
    </div>
</header>  
		      
<div class="container">
  {ALERTS}
</div>

<!-- Services Section No.1 menu 1 + 11 12 13 -->
<section id="ourservices" class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                {SETSTYLE=notitle}
                {MENU=1}
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                {SETSTYLE=notitle}
                {MENU=11}
            </div>
            <div class="col-md-4">
                {SETSTYLE=notitle}
                {MENU=12}
            </div>
            <div class="col-md-4">
                {SETSTYLE=notitle}
                {MENU=13}
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid Section No.2 -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                {SETSTYLE=notitle}
                {MENU=2}
            </div>
        </div> 	
				<div class="row">					    
					{PORTFOLIOITEMS}
				</div>
   </div>
</section>
    
<!-- About Section No.3 menu 3 + ...-->
<section id="about">
    <div class="container">
        <div class="row">           
          <div class="col-lg-12 text-center">
            {SETSTYLE=notitle}
            {MENU=3} 
					</div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            {TIMELINEITEMS}
          </div>
        </div>
    </div>
</section>

    <!-- Team Section Section N.4 - menu 4 -->
    <section id="team" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    {SETSTYLE=notitle}
                		{MENU=4}
                </div>
            </div>
            <div class="row">
                {TEAMMEMBERS}
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p class="large text-muted">'.e107::pref('theme', 'textafterteam','').'</p>
                </div>
            </div>
        </div>
    </section>

<!-- Clients Aside Section N. 5 -->
<aside class="clients">
    <div class="container">
        <div class="row">
            {SETSTYLE=notitle}
            {GALLERY_PORTFOLIO: category=2&limit=4}             
        </div>
    </div>
</aside>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    {SETSTYLE=notitle}
                		{MENU=5}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {AGENCY_CONTACTFORM}
                </div>
            </div>
        </div>
    </section>        
';


$LAYOUT['full'] = '  
{SETSTYLE=default}
<div class="container">	
  {ALERTS}
  {MENU=1}
  {---}
</div>';

$LAYOUT['sidebar_right'] =  ' 
    
{SETSTYLE=default}
<div class="container">	
<section id="services">
  {ALERTS}
  <div class="row">
    <div class="col-xs-12 col-md-8">	
    {---}
    </div>
    <div id="sidebar" class="col-xs-12 col-md-4">
      {SETSTYLE=menu}
      {MENU=1}
      </div>
  </div>
</div>
</section>';
 
 
$NEWSCAT = "\n\n\n\n<!-- News Category -->\n\n\n\n
	<div style='padding:2px;padding-bottom:12px'>
	<div class='newscat_caption'>
	{NEWSCATEGORY}
	</div>
	<div style='width:100%;text-align:left'>
	{NEWSCAT_ITEM}
	</div>
	</div>
";


$NEWSCAT_ITEM = "\n\n\n\n<!-- News Category Item -->\n\n\n\n
		<div style='width:100%;display:block'>
		<table style='width:100%'>
		<tr><td style='width:2px;vertical-align:middle'>&#8226;&nbsp;</td>
		<td style='text-align:left;height:10px'>
		{NEWSTITLELINK}
		</td></tr></table></div>
";

?>
