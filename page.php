<?php get_header(); ?>
	<div id="content" class="span-17 append-1" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>

			<div class="entry span-17 append-1 last">
				<?php the_content(); ?>

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
