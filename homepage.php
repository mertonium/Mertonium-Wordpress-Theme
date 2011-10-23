<?php
/*
Template Name: Homepage Showcase
*/
    get_header();

    $params = array(
        'meta_key' => 'showcase',
        'meta_value' => 'tool',
        'numberposts' => -1,
        'post_type' => array('page','post')
    );
    $tools = get_posts($params);

    $params['meta_value'] = 'article';
    $articles = get_posts($params);
?>
    <div class="span-24 last" role="main">
        <div class="span-18">
            <?php if (count($tools) > 0) : ?>
                <div class="span-18 last section-wrapper" role="main">
                    <h2 class="hp-section">Projects</h2>
                <?php
                    $counter = 0;
                    foreach($tools as $post ) :
                        setup_postdata($post);

                        $last = ($counter % 3 === 2) ? ' last' : '';
                        $counter++;
                        $the_classes = get_post_class('hp-block span-6'.$last);
                        $the_classes = implode(' ',$the_classes);
                ?>
                    <div class="<?php print_r($the_classes); ?>" id="post-<?php the_ID(); ?>">
                        <div class="hp-heading"><a href="<?php the_permalink() ?>" class="hp-title-link" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
                        <?php
                            if (function_exists('has_post_thumbnail')) {
                                if (has_post_thumbnail()) {
                        ?>
                                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(230,230), array('class' => 'size-small')); ?></a>
                        <?php
                                } else {
                                    the_content('{Jump to the rest of &quot;'.get_the_title().'&quot;}');
                                }
                            }
                        ?>
                    </div>
                    <?php if($last != ''){ echo '<br style="clear:both;" />'; } ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="span-18 last section-wrapper" role="main">
                <h2 class="hp-section">Tech Posts</h2>
            <?php
                $counter = 0;
                foreach($articles as $post ) :
                    setup_postdata($post);

                    $last = ($counter % 3 == 2) ? ' last' : '';
                    $counter++;
                    $the_classes = get_post_class('hp-block span-6'.$last);
                    $the_classes = implode(' ',$the_classes);
            ?>
                <div class="<?php print_r($the_classes); ?>" id="post-<?php the_ID(); ?>">
                    <h2 class="hp-heading"><a href="<?php the_permalink() ?>" class="hp-title-link" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                        if (function_exists('has_post_thumbnail')) {
                            if (has_post_thumbnail()) {
                    ?>
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array(230,230), array('class' => 'size-small')); ?></a>
                    <?php
                            } else {
                                the_content('{Jump to the rest of &quot;'.get_the_title().'&quot;}');
                            }
                        }
                    ?>
                </div>
                <?php if($last != ''){ echo '<br style="clear:both;" />'; } ?>
            <?php endforeach; ?>
            </div>
            
        </div>
        <div class="span-6 last">
            <h2 class="hp-section">Bio</h2>
            <div class="span-6 last">
            <?php
                if (have_posts()) {
                    while (have_posts()) {
                      the_post();
                      the_content();
                    }
                }
            ?>
            </div>
        </div>
    </div>


<?php
    //get_sidebar();
    get_footer();
?>