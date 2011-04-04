<?php get_header(); ?>
	<script type="text/javascript">
		var jm_evnt = (window.webkit) ? 'load' : 'domready';
		window.addEvent(jm_evnt, function () {
			$$('div.wp-caption').each(function(el, idx) {
				if(el.id.indexOf('frontonly') != -1) {
					el.setStyle('display','none');
				}
			});
		});
	</script>
	<div id="content" class="span-17 append-1" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation span-17 last">
			<div class="alignleft"><?php previous_post_link('&larr; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &rarr;') ?></div>
		</div>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>

			<div class="entry span-17 append-1 last">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<div class="tag-div">Tags: <span>&lceil;', '&rfloor;</span> <span>&lceil;', '&rfloor;</span></div>'); ?>
				<div class="share-this-buttons">
					Share: <span class="st_facebook"></span><span class="st_twitter"></span><span class="st_delicious"></span><span class="st_digg"></span><span class="st_stumbleupon"></span><span class="st_blogger"></span><span class="st_reddit"></span><span class="st_email"></span><!--span class="st_sharethis" displayText="ShareThis"></span-->
				</div>
			</div>
		</div>
	<?php related_posts(); ?>
	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
