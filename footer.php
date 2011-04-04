	</div>
</div>
	<div id="footer" >
		<div id="footer_wrapper" class="container">
			<div class="span-24 last">
				<?php 
					if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar(2) ) { }
				?>
			</div>
			<div class="footer-small-print">
				&copy;2009 &mdash; <?php echo date('Y'); ?> <a href="http://mertonium.com">Mertonium</a> /
				<a href="/colophon/" title="How'd he do it?">Colophon</a> /
				<a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> / 
				<a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
