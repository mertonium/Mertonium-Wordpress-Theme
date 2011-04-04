<?php /*
Example template for use with post thumbnails
Requires WordPress 2.9 and a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>

<?php if ($related_query->have_posts()):?>
<div id="related_posts">
<h3>Other stuff like this</h3>
<?php $idx = 1; ?> 
<ul class="related-post-ul">
	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
		<?php if (function_exists('has_post_thumbnail')): if (has_post_thumbnail()):?>
		<?php 
			$exClass = ($idx % 4 == 0) ? 'last' : ''; 
			$idx++;
		?>
		<li class="<?php echo $exClass; ?>">
			<a href="<?php the_permalink() ?>" class="related-post-link" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail'); ?>
				<span><?php the_title_attribute(); ?></span>
			</a>
		</li>
		<?php endif; endif; ?>
	<?php endwhile; ?>
</ul>
<br style="clear:both" />
</div>
<?php endif; ?>
