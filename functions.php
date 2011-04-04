<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebars(2, array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

function mertonium_gallery($atts=null, $content = null) {
	extract(shortcode_atts(array(
		'delay' => '3000',
		'duration' => '1000',
		'repeat'=>'on',
		'exclude'=>''
	), $atts));
?>
<style type="text/css">
	div#mertonium-gallery {
		width: 670px;
		height: 502px;
		border: 2px solid #ccc;
		background-color: #efefef;
	}
	div#mertonium-gallery div.active {
		display:block;
	}
	
	div#mertonium-gallery div.gal-img {
		width: 670px;
		height: 502px;
		background-repeat: no-repeat;
		background-position: center center;
		position: absolute;
		overflow: hidden;
	}
	
	div#mertonium-gallery div.gal-inside {
		margin-top: 502px;
		padding-left: 18px;
		height: 65px;
		background-image: url('/wp-content/themes/mertonium/images/grey-alpha.png');
	}
	
	div#mertonium-gallery div.gal-inside span p{		
		font-size: 1.2em;
	}
	div#mertonium-gallery div.gal-inside p{
		font-size: 1em;
		color: #ffffff;
		font-family: 'Georgia', serif;
	}
	div#mertonium-gallery div.gal-inside span p{ margin: 0px; }
	div#mertonium-gallery div.gal-inside p{ margin: 0px; }
	div#mg-navigation {
		margin-bottom: 1em;
		border-bottom: 1px solid #efefef;
	}
</style>
<script type="text/javascript">
	var rotator;
	
	function startRotator() {
		rotator = rotate.periodical(<?php echo $delay; ?>);
	}
	
	var evnt = (window.webkit) ? 'load' : 'domready';
	window.addEvent(evnt, function() {
		if($defined($('mertonium-gallery'))) {
			//$$('#mertonium-gallery div.gal-img').setStyle('display','none');
			$$('#mertonium-gallery div.gal-img').fade('out');
			$$('#mertonium-gallery div.gal-img')[0].fade('in');
			$('mg-play').setStyle('display','none');			
			
			startRotator.delay(<?php echo $delay*2; ?>)
			
			$('mg-prev').addEvent('click', function(ev) { 
				var ev = new Event(ev);
				ev.stop();
				$clear(rotator); 
				rotate('down');
				$('mg-pause').setStyle('display','none');
				$('mg-play').setStyle('display','inline');				
			});
			$('mg-next').addEvent('click', function(ev) { 
				var ev = new Event(ev);
				ev.stop();
				$clear(rotator); 
				rotate(); 
				$('mg-pause').setStyle('display','none');
				$('mg-play').setStyle('display','inline');
				
			});
			$('mg-play').addEvent('click', function(ev) {
				var ev = new Event(ev);
				ev.stop();
				$clear(rotator);
				rotate();
				startRotator.delay(<?php echo $delay; ?>);
				$('mg-pause').setStyle('display','inline');
				$('mg-play').setStyle('display','none');
			});
			$('mg-pause').addEvent('click', function(ev) {
				var ev = (ev) ? new Event(ev): false;
				if(ev) ev.stop();
				$clear(rotator);				
				$('mg-pause').setStyle('display','none');
				$('mg-play').setStyle('display','inline');
			});
		}				
	});
	
	function rotate(dir) {
		dir = dir || 'up';
		var curImg;
		var repeat = '<?php echo strtolower($repeat); ?>';
		if($defined($$('#mertonium-gallery .active')[0]) && $$('#mertonium-gallery .active').length > 0) {
			curImg = $$('#mertonium-gallery .active')[0];
		} else { 
			$$('#mertonium-gallery div.gal-img').setStyle('opacity','0');
			curImg = $$('#mertonium-gallery div.gal-img')[0];
			curImg.setStyle('opacity','1');
			curImg.addClass('active');
			return;
		}	
		var images = $$('#mertonium-gallery div.gal-img');
		var nextImg;
		if(dir == 'up') {
			if(repeat == 'on') {
				nextImg = ($defined(curImg.getNext())) ? curImg.getNext() : images[0];
			} else {
				if($defined(curImg.getNext())) {
					nextImg = curImg.getNext();					
				} else {
					$('mg-pause').fireEvent('click');
					$$('div.gal-img').removeClass('active');
					return;
				}
			}
		} else {
			nextImg = ($defined(curImg.getPrevious())) ? curImg.getPrevious() : images[images.length-1];
		}
		
		$$('#mertonium-gallery div.gal-img').removeClass('active');				
		nextImg.addClass('active');
		
	<?php
		if($duration > 0) {
	?>
		$(curImg).set('tween', { duration: <?php echo $duration; ?>, link:'chain'});
		$(nextImg).set('tween', { duration: <?php echo $duration; ?>, link:'chain'});
		$(curImg).tween('opacity', '0');
		$(nextImg).tween('opacity', '1');
	<?php
		} else {
	?>
		$(curImg).setStyle('opacity','0');
		$(nextImg).setStyle('opacity','1');
	<?php
		}
	?>
		$(curImg).getFirst().tween('margin-top','502px');
		if($(nextImg).getFirst().get('text') != "") {
			$(nextImg).getFirst().tween('margin-top','437px');
		}
		
	}
</script>
<?php
	// Display gallery
	global $post;
	$galHtml = "";
	$args = array(
		'post_type' => 'attachment',
		'numberposts' => -1,
		'post_status' => null,
		'post_parent' => $post->ID,
		'orderby'=>'menu_order',
		'order'=>'ASC'
		); 
	if($exclude != '') {
		$args['exclude'] = $exclude;
	}
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ($attachments as $attachment) {
			if(wp_attachment_is_image($attachment->ID)) {								
				$article_image = wp_get_attachment_image_src($attachment->ID,'medium');
				$galHtml .= '<div class="gal-img" style="background-image: url(\'' . $article_image[0] . '\'); ">'
						   .'<div class="gal-inside">'
						   .'<span>' . apply_filters('the_excerpt', $attachment->post_excerpt) . '</span>'
						   . apply_filters('the_content', $attachment->post_content)
						   .'</div>'
						   .'</div>';
			}
		}		
	}
	$galHtml = '<div id="mertonium-gallery">'.$galHtml.'</div>';
	$galHtml .= '<div id="mg-navigation" class="span-17 last"><div class="span-13"><a id="mg-play" href="#">Play</a><a id="mg-pause" href="#">Pause</a></div><div class="span-2" style="text-align:right"><a href="#" id="mg-prev">Previous</a></div><div class="span-2 last" style="text-align:right"><a href="#" id="mg-next">Next</a></div></div>';
	
	echo $galHtml;
}
add_shortcode("mertonium_gallery", "mertonium_gallery");

function new_excerpt_more($post) {
	return '...<a class="read-more" href="'. get_permalink($post->ID) . '">' . '&nbsp;&nbsp;Jump to the rest of &laquo;'. get_the_title($post->ID) . '&raquo;&nbsp;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(216,100,true );
}

?>