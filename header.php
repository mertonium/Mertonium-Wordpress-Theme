<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-Script-Type" content="text/javascript"></meta>
	<meta http-equiv="Content-Style-Type" content="text/css"></meta>
	<meta name="google-site-verification" content="WAYYTY8uNnc27-kW-ZIY2HF3FJUcS1NGXa39sIM7KPg" />
	
	<title><?php wp_title(' / ', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="/wp-content/themes/mertonium/blueprint/blueprint-combined.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="/wp-content/themes/mertonium/blueprint/print.css" type="text/css" media="print" />
	<!--link rel="stylesheet" href="/wp-content/themes/mertonium/blueprint/src/typography.css" type="text/css" media="print" /-->
	<!--[if lt IE 8]>
	  <link rel="stylesheet" href="/wp-content/themes/mertonium/blueprint/ie.css" type="text/css" media="screen, projection">
	<![endif]-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	<script type="text/javascript" src="/wp-content/themes/mertonium/js/mootools.js"></script>
	<script type="text/javascript" src="/wp-content/themes/mertonium/js/cufon-yui.js"></script>
	<script type="text/javascript" src="/wp-content/themes/mertonium/js/nilland_400.font.js"></script>
	<script type="text/javascript">
		var evt = (window.webkit) ? 'load' : 'domready';
		window.addEvent(evt, function() {
			//FLIR.init( { path: '/wp-content/themes/mertonium/facelift/' } );
			//$$("h2, h3").each( function(el) { FLIR.replace(el, new FLIRStyle({ cFont:'nilland' , mode:'wrap' })); } );
			//$$("div#logo h1").each( function(el) { FLIR.replace(el, new FLIRStyle({ cFont:'coventry' , mode:'wrap' })); } );
			Cufon.replace('h2, h3, ul.related-post-ul span');
			
			// Add the 'last' class to every 3rd  footer widget
			$$('#footer li.widget').each(function(el, idx) {
				if(idx%3 == 2) {
					$(el).addClass('last');
				}
			});
		});
	</script>
	<!-- "Share this" code -->
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'77fb8a3e-7089-49b5-b5f5-72ca13881cef'});</script>
</head>
<body <?php body_class(); ?>>
	<div id="container_main" class="container">
		<div id="header" class="span-24 last">
			<div id="logo" class="span-18">
			<?php
				if(is_category('daily-photo')) { ?>
				<h1 style="display:none;">Daily Photo</h1>				
				<a href="<?php echo get_option('home'); ?>/"><img src="/wp-content/themes/mertonium/images/logo-daily-photo.png" alt="Logo for Daily Photo by Mertonium" /></a>							
			<?php } else { ?>
				<h1 style="display:none;">Mertonium</h1>				
				<a href="<?php echo get_option('home'); ?>/"><img src="/wp-content/themes/mertonium/images/logo-coventrygarden.png" alt="Logo for <?php bloginfo('name'); ?>" /></a>			
			<?php } ?>
			</div>
			<div id="search_box" class="span-6 last">
				<?php get_search_form(); ?>
			</div>
		</div>
		<div id="the_page" class="span-24 last">
		
