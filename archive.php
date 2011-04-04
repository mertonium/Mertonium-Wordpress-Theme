<?php get_header(); ?>
<div id="content" class="span-17 append-1" role="main">
<?php if (have_posts()) { ?>
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php single_cat_title(); ?></h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php the_time('Y'); ?> </h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Archives</h2>
 	  <?php } ?>


		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
<?php //echo '<!-- DEBUG: HELLO -->';	?>
		<?php while (have_posts()) : the_post(); ?>
		<?php 	if(!is_category('daily-photo') ) { ?>
			<div <?php post_class() ?>>
				<?php
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => 1,
						'post_status' => null,
						'post_parent' => get_the_ID(),
						'orderby'=>'menu_order',
						'order'=>'ASC'
						); 
//echo '<!-- DEBUG: ' . print_r($args, true) . ' -->';						
					$attachments = get_posts($args);
//echo '<!-- DEBUG: ' . print_r($attachments, true) . ' -->';							
					if ($attachments) {
						foreach ($attachments as $attachment) {
							//echo apply_filters('the_title', $attachment->post_title);
							//the_attachment_link($attachment->ID, false);
							$article_image = wp_get_attachment_image_src($attachment->ID,'thumbnail');
//echo '<!-- DEBUG: ' . print_r($article_image, true) . ' -->';							
						}
					} else {
						$article_image[0] = '';
					}
				?>
			
				<div class="span-4" >
					 <div class="archive-img" style="background-image: url('<?php echo $article_image[0]; ?>');">&nbsp;</div>
				</div>
				<div class="archive-desc span-12 prepend-1 last">
					<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<small><?php the_time('l, F jS, Y') ?></small>
					<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				</div>
			</div>
		<?php 
				}
				endwhile; 
		?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
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

<?php get_sidebar(); ?>

<?php get_footer(); ?>
