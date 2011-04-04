<?php get_header(); ?>
<div id="content" class="span-23 append-1" role="main">
<?php if (have_posts()) { ?>
 	 	<div class="navigation">			
			<div class="alignleft"><?php previous_posts_link('&lt;&#8212; Newer Entries') ?></div>
			<div class="alignright"><?php next_posts_link('Older Entries &#8212;&gt;') ?></div>
		</div>
<?php //echo '<!-- DEBUG: HELLO -->';	?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class('span-23 last') ?>>
				<?php
					$custom_fields = get_post_custom(get_the_ID());
echo '<!-- '.print_r($custom_fields, true) .' -->';					
					$bg_top = (isset($custom_fields['bg_top']) && $custom_fields['bg_top'][0] != '') ? $custom_fields['bg_top'][0] : '0';
					$bg_left = (isset($custom_fields['bg_left']) && $custom_fields['bg_left'][0] != '') ? $custom_fields['bg_left'][0] : '0';
echo '<!-- '.$bg_top . '  '. $bg_left .' -->';				
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => 1,
						'post_status' => null,
						'post_parent' => get_the_ID(),
						'orderby'=>'menu_order',
						'order'=>'ASC'
						); 					
					$attachments = get_posts($args);
					
					if ($attachments) {
						foreach ($attachments as $attachment) {
							$article_image = wp_get_attachment_image_src($attachment->ID,'full');							
						}
					} else {
						$article_image[0] = '';
					}
				?>
				<div id="blind_wrapper_<?php echo get_the_ID(); ?>" class="blind-wrapper">
					<div id="blind_content_<?php echo get_the_ID(); ?>"class="archive-desc">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><span id="post-<?php the_ID(); ?>"><?php the_title(); ?></span></a>
						<br />
						<small><?php the_time('l, F jS, Y') ?></small>
						<!--p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p-->
					</div>
				</div>
				<script type="text/javascript">
					var jvnt = (window.webkit) ? 'load':'domready';
					window.addEvent(jvnt, function() {						
						var blind_img = new Element("div", { 
							'styles': { 
								'background' : 'transparent url(<?php echo $article_image[0]; ?>) no-repeat <?php echo $bg_left; ?> <?php echo $bg_top; ?>',
								'height':'150px'
							}
						});
						var blind_img_div = new Element('div', {'id': 'blind_img_<?php echo get_the_ID(); ?>', 'class': 'blind_img'});
						blind_img_div.setStyles({'width': 950, 'height': 150});
						blind_img.inject(blind_img_div,'top');
						blind_img_div.inject('blind_wrapper_<?php echo get_the_ID(); ?>','top');
						//slide image in
						var blind_imgFx = new Fx.Slide(blind_img_div, {duration: 100, mode: 'vertical'}).hide().slideIn();

						//initialize content
						$('blind_content_<?php echo get_the_ID(); ?>').setStyle('display', 'block');

						var content_wrap = new Element('div');
						content_wrap.inject('blind_wrapper_<?php echo get_the_ID(); ?>');

						$('blind_content_<?php echo get_the_ID(); ?>').inject(content_wrap);

						var contentFx_<?php echo get_the_ID(); ?> = new Fx.Tween(content_wrap, {wait: false}).start('margin-top',0);

						content_wrap.setStyle('margin-top', $('blind_content_<?php echo get_the_ID(); ?>').getCoordinates().height);

						//toggle slide when hovering
						$('blind_wrapper_<?php echo get_the_ID(); ?>').addEvents({
							'mouseenter': function() {
								contentFx_<?php echo get_the_ID(); ?>.start('margin-top',-150);
							},
							'mouseleave': function() {
								contentFx_<?php echo get_the_ID(); ?>.start('margin-top',0);
							}
						});
					});
				</script>
				<!--div class="archive-img" style="background-image: url('<?php echo $article_image[0]; ?>');">&nbsp;</div-->
			</div>
		<?php endwhile; ?>

		<div class="navigation">			
			<div class="alignleft"><?php previous_posts_link('&lt;&#8212; Newer Entries') ?></div>
			<div class="alignright"><?php next_posts_link('Older Entries &#8212;&gt;') ?></div>
		</div>
<?php } else {

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	}
?>
	</div>

<?php get_footer(); ?>
