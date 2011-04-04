<?php get_header(); ?>

	<div id="content" class="span-17 append-1" role="main">
	<?php query_posts($query_string . '&cat=-77'); ?>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

				<div class="entry">
				<?php
					if (function_exists('has_post_thumbnail')) {
						if (has_post_thumbnail()) { 
				?>
							<div class="frontpage-featured-image ">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(670,1024), array('class' => 'size-medium')); ?></a><p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
							</div>
							<div><?php the_excerpt();  ?></div>
				<?php
						} else {
							the_content('{Jump to the rest of &quot;'.get_the_title().'&quot;}'); 
						}
					}
				?>
				</div>

				<p class="postmetadata"><?php //the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
