	<div id="sidebar" class="span-6 last" role="complementary">
		<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : 
					if ( is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged() ) {
			?> 
						<li>

						<?php /* If this is a 404 page */ if (is_404()) { ?>
						<?php /* If this is a category archive */ } elseif (is_category()) { ?>
						<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

						<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
						<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
						for the day <?php the_time('l, F jS, Y'); ?>.</p>

						<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
						for <?php the_time('F, Y'); ?>.</p>

						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
						for the year <?php the_time('Y'); ?>.</p>

						<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
						<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
						for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

						<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>
						<?php } ?>

						</li>
				
				<?php } ?>
		</ul>
		<?php endif; ?>
		<?php if(is_single()) { ?>
				<h3>About this post</h3>
				<ul class="postmetaoptions">
					<li><span>posted:</span> <?php the_time('j F Y') ?></li>
					<li><span>filed under:</span> <?php the_category(', ') ?></li>
					<li><?php post_comments_feed_link('comments feed'); ?> </li>
					<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							<li><a href="#respond">leave a response</a>
						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							<!--Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.-->

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } ?>
						<li><?php edit_post_link('edit this entry','',''); ?></li>

					
				</ul>
		<?php } ?>
	</div>